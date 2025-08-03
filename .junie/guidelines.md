# Style Guidelines

This document outlines the coding style guidelines for the CitiMed application. All code changes should adhere to these guidelines.

## PHP Guidelines

### Naming Conventions

- **Classes**: Use PascalCase (e.g., `PatientController`, `VisitModel`)
- **Methods and Functions**: Use camelCase (e.g., `createVisit()`, `getPatientDetails()`)
- **Variables**: Use camelCase (e.g., `$patientName`, `$visitDate`)
- **Constants**: Use UPPER_SNAKE_CASE (e.g., `MAX_VISITS`, `DEFAULT_TIMEOUT`)
- **Database Columns**: Use snake_case (e.g., `first_name`, `date_of_birth`)

### Code Structure

- Use 4 spaces for indentation, not tabs
- Place opening braces on the same line for classes, methods, and control structures
- Add a space before opening parentheses for control structures (if, for, while, etc.), but not for method calls
- Use explicit visibility declarations for all class properties and methods (public, protected, private)
- Limit line length to 120 characters where possible

### Documentation

- All classes should have a PHPDoc comment explaining their purpose
- All methods should have a PHPDoc comment explaining what they do, their parameters, and return values
- Complex code sections should have inline comments explaining the logic

### Laravel & Livewire Specific

- Follow Laravel naming conventions for controllers, models, and other components
- Use Laravel's built-in validation rules when possible
- Organize Livewire component properties at the top of the class
- Use Livewire's lifecycle hooks appropriately
- Keep Livewire components focused on a single responsibility

## Blade Templates

- Use 2 spaces for indentation in Blade templates
- Use kebab-case for CSS classes and IDs
- Organize Blade components in a logical hierarchy
- Extract reusable UI elements into components
- Keep templates clean and focused on presentation logic

## JavaScript

- Use ES6+ syntax where possible
- Use camelCase for variables and functions
- Use PascalCase for classes and components
- Add appropriate comments for complex logic
- Prefer arrow functions for callbacks

## CSS/SCSS

- Use kebab-case for class names
- Organize CSS using a component-based approach
- Use variables for colors, spacing, and other repeated values
- Minimize the use of !important
- Follow a mobile-first approach for responsive design

## Git Commit Messages

- Use the imperative mood in the subject line (e.g., "Add feature" not "Added feature")
- Limit the subject line to 50 characters
- Capitalize the subject line
- Do not end the subject line with a period
- Separate subject from body with a blank line
- Wrap the body at 72 characters
- Use the body to explain what and why vs. how
