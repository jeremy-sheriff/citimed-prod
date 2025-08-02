# Data Flow Diagram Analysis for CitiMed System

## External Entities (Actors)

Based on the code examined, the following external entities interact with the system:

1. **Users with different roles**:
   - Super Admin
   - Doctor
   - Nurse
   - Lab Technician
   - Pharmacist
   - Receptionist
   - Finance Officer
   - Inventory Manager
   - HR Officer

2. **Patients**: The people receiving medical care

3. **Payment Systems**:
   - Cash handling system
   - M-Pesa (mobile payment)
   - Possibly other payment methods (bank transfer, insurance)

## Main Processes

The main processes in the system include:

1. **User Authentication and Authorization**:
   - Login/logout
   - Role-based access control

2. **Patient Management**:
   - Patient registration
   - Patient search and filtering
   - Patient information update
   - Patient deletion

3. **Visit Management**:
   - Creating new patient visits
   - Recording medical information
   - Viewing patient visit history

4. **Financial Management**:
   - Recording payments
   - Calculating balances
   - Tracking payment history

5. **Reporting**:
   - Exporting patient data
   - Possibly other reporting features

## Data Stores

The main data stores in the system include:

1. **Users**: Stores user information and credentials
2. **Roles and Permissions**: Stores role definitions and permissions
3. **Patients**: Stores patient demographic and contact information
4. **Visits**: Stores medical information from patient visits
5. **Payments**: Stores payment information related to visits
6. **Balances**: Stores balance information (appears to be under development)

## Data Flows

The main data flows in the system include:

1. **Patient Registration Flow**:
   - User enters patient information
   - System validates and stores patient data
   - System generates patient number

2. **Visit Creation Flow**:
   - User searches and selects a patient
   - User enters medical information (complaints, history, examination, diagnosis, etc.)
   - User enters financial information (amount charged, amount paid, payment method)
   - System calculates balance
   - System creates visit, payment, and balance records

3. **Patient Search Flow**:
   - User enters search criteria
   - System queries patient database
   - System returns matching patients

4. **Payment Processing Flow**:
   - User enters payment information
   - System records payment
   - System updates balance

5. **Authorization Flow**:
   - System checks user roles and permissions
   - System grants or denies access to features
