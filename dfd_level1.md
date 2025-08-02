# Level 1 Data Flow Diagram

```
                                +----------------+
                                |                |
                                |    System      |
                                |    Users       |
                                |    (Staff)     |
                                |                |
                                +----------------+
                                    |       ^
                                    |       |
                    Authentication  |       | User Data
                    Credentials     |       |
                                    v       |
                            +-------------------+
                            |                   |
                            |  1.0              |
                            |  Authentication & |
                            |  Authorization    |
                            |                   |
                            +-------------------+
                                    |       ^
                                    |       |
                        User ID,    |       | Role &
                        Permissions |       | Permission Data
                                    v       |
                            +-------------------+         +---------------+
                            |                   |         |               |
                            |  D1               |<------->|    Users      |
                            |  Users &          |         |    Database   |
                            |  Permissions      |         |               |
                            |                   |         +---------------+
                            +-------------------+
                                    |       ^
                                    |       |
                                    |       |
                                    |       |
                                    v       |
+----------------+           +-------------------+         +---------------+
|                |           |                   |         |               |
|                |---------->|  2.0              |<------->|    Patients   |
|    Patients    |  Patient  |  Patient          |         |    Database   |
|                |   Data    |  Management       |         |               |
|                |<----------|                   |         +---------------+
+----------------+  Medical  +-------------------+
                    Services         |       ^
                                     |       |
                                     |       |
                                     v       |
                            +-------------------+         +---------------+
                            |                   |         |               |
                            |  3.0              |<------->|    Visits     |
                            |  Visit            |         |    Database   |
                            |  Management       |         |               |
                            |                   |         +---------------+
                            +-------------------+
                                    |       ^
                                    |       |
                                    |       |
                                    v       |
+----------------+           +-------------------+         +---------------+
|                |  Payment  |                   |         |               |
|    Payment     |   Data    |  4.0              |<------->|    Payments   |
|    Systems     |---------->|  Financial        |         |    Database   |
|                |           |  Management       |         |               |
|                |<----------|                   |         +---------------+
+----------------+ Transaction+-------------------+         +---------------+
                 Confirmation         |       ^            |               |
                                      |       |            |    Balances   |
                                      |       |<---------->|    Database   |
                                      |       |            |               |
                                      |       |            +---------------+
                                      v       |
                            +-------------------+
                            |                   |
                            |  5.0              |
                            |  Reporting &      |
                            |  Analytics        |
                            |                   |
                            +-------------------+
                                      |
                                      |
                                      | Reports &
                                      | Summaries
                                      |
                                      v
                            +-------------------+
                            |                   |
                            |    System         |
                            |    Users          |
                            |    (Staff)        |
                            |                   |
                            +-------------------+
```

## Description

This Level 1 Data Flow Diagram shows the main processes within the CitiMed system and how they interact with data stores and external entities:

### Processes

1. **1.0 Authentication & Authorization** - Handles user login, authentication, and role-based access control
2. **2.0 Patient Management** - Manages patient registration, search, updates, and deletion
3. **3.0 Visit Management** - Handles creating and managing patient visits and medical records
4. **4.0 Financial Management** - Processes payments, calculates balances, and manages financial transactions
5. **5.0 Reporting & Analytics** - Generates reports and analytics for staff

### Data Stores

1. **D1 Users & Permissions** - Stores user information, roles, and permissions
2. **Patients Database** - Stores patient demographic and contact information
3. **Visits Database** - Stores medical information from patient visits
4. **Payments Database** - Stores payment information related to visits
5. **Balances Database** - Stores balance information for patients

### External Entities

1. **System Users (Staff)** - Healthcare professionals and administrative staff
2. **Patients** - Individuals receiving medical care
3. **Payment Systems** - External payment processing systems

### Key Data Flows

- Authentication credentials and user data between Staff and Authentication process
- Patient data between Patients and Patient Management process
- Medical services information between Patient Management and Patients
- Visit information between Visit Management and Visits Database
- Payment data between Payment Systems and Financial Management
- Transaction confirmations between Financial Management and Payment Systems
- Reports and summaries from Reporting process to Staff
