# Deployment Workflow Changes

## Overview

The GitHub Actions workflow for deploying the CitiMed application has been updated to upload individual files to the FTP server instead of a zip archive. This change was necessary because there is no SSH access to the shared server to unzip the artifact.

## Changes Made

### 1. Build Job Modifications

- Removed the zip creation step that was previously creating `app.zip`
- Updated the artifact upload to include individual files with specific exclusions:
  ```yaml
  - name: Upload artifact for deployment job
    uses: actions/upload-artifact@v4
    with:
      name: app-build
      path: |
        .
        !vendor/
        !node_modules/
        !.git/
        !.github/
        !tests/
        !*.md
        !.env.example
        !phpunit.xml
        !docker-compose.yml
      retention-days: 1
  ```

### 2. Deploy Job Modifications

- Updated the artifact download step to specify a path for the files:
  ```yaml
  - name: Download artifact from build job
    uses: actions/download-artifact@v4
    with:
      name: app-build
      path: ./deploy-files
  ```

- Modified the FTP upload configuration to handle individual files:
  ```yaml
  - name: Upload to FTP server
    uses: SamKirkland/FTP-Deploy-Action@v4.3.5
    with:
      server: ${{ secrets.FTP_HOST }}
      username: ${{ secrets.FTP_USERNAME }}
      password: ${{ secrets.FTP_PASSWORD }}
      protocol: ftp
      port: 21
      server-dir: /domains/citimedhospital.co.ke/
      local-dir: ./deploy-files/
      dangerous-clean-slate: false
      exclude: |
        **/.git*
        **/.git*/**
        **/node_modules/**
        **/vendor/**
        **/tests/**
  ```

## Important Notes

1. The `dangerous-clean-slate: false` option ensures that existing files on the server that aren't part of the deployment won't be deleted.

2. The workflow excludes the `vendor/` directory, which means PHP dependencies won't be uploaded. This is typically fine if:
   - Dependencies are already installed on the server
   - There's a separate process to install dependencies
   - The server has Composer installed and runs `composer install` as part of the deployment

   If dependencies need to be included in the deployment, modify the exclusion lists in both the build and deploy jobs.

3. The exclusion patterns in the deploy job provide an extra layer of protection to ensure development files aren't uploaded to the production server.

## Testing

After these changes, the workflow should:
1. Build the application as before
2. Upload individual files to the artifact storage
3. Download these files to the `./deploy-files` directory
4. Upload the individual files to the FTP server

This eliminates the need to unzip files on the server after deployment.
