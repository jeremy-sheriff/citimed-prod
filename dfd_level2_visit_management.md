# Level 2 Data Flow Diagram - Visit Management Process

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
                        Patient     |       | Patient
                        Search      |       | List
                        Criteria    |       |
                                    v       |
                            +-------------------+         +---------------+
                            |                   |         |               |
                            |  3.1              |<------->|    Patients   |
                            |  Patient          |         |    Database   |
                            |  Search &         |         |               |
                            |  Selection        |         +---------------+
                            |                   |
                            +-------------------+
                                    |       ^
                                    |       |
                        Selected    |       | Patient
                        Patient ID  |       | Details
                                    v       |
                            +-------------------+
                            |                   |
                            |  3.2              |
                            |  Medical          |
                            |  Information      |
                            |  Entry            |
                            |                   |
                            +-------------------+
                                    |       ^
                                    |       |
                        Medical     |       | Validation
                        Data        |       | Results
                                    v       |
                            +-------------------+         +---------------+
                            |                   |         |               |
                            |  3.3              |<------->|    Visits     |
                            |  Visit            |         |    Database   |
                            |  Creation &       |         |               |
                            |  Storage          |         +---------------+
                            |                   |
                            +-------------------+
                                    |       ^
                                    |       |
                        Visit       |       | Previous
                        ID          |       | Balance
                                    v       |
                            +-------------------+         +---------------+
                            |                   |         |               |
                            |  3.4              |<------->|    Payments   |
                            |  Financial        |         |    Database   |
                            |  Information      |         |               |
                            |  Processing       |         +---------------+
                            |                   |
                            +-------------------+         +---------------+
                                    |       ^            |               |
                                    |       |            |    Balances   |
                        Payment     |       |<---------->|    Database   |
                        Data        |       |            |               |
                                    v       |            +---------------+
                            +-------------------+
                            |                   |
                            |  3.5              |
                            |  Visit            |
                            |  Confirmation     |
                            |  & Summary        |
                            |                   |
                            +-------------------+
                                    |
                                    |
                                    | Visit
                                    | Summary
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

This Level 2 Data Flow Diagram provides a detailed breakdown of the Visit Management process (3.0) from the Level 1 DFD. It shows the subprocesses involved in creating and managing patient visits:

### Subprocesses

1. **3.1 Patient Search & Selection** - Allows staff to search for and select a patient for a visit
2. **3.2 Medical Information Entry** - Captures medical data for the visit (complaints, history, examination, diagnosis, etc.)
3. **3.3 Visit Creation & Storage** - Validates and stores the visit information in the database
4. **3.4 Financial Information Processing** - Handles payment information, calculates balances
5. **3.5 Visit Confirmation & Summary** - Generates a summary of the visit and confirms completion

### Data Stores

1. **Patients Database** - Used to search for and retrieve patient information
2. **Visits Database** - Stores the medical information for each visit
3. **Payments Database** - Stores payment information related to visits
4. **Balances Database** - Stores balance information for patients

### Key Data Flows

- Patient search criteria and patient list between Staff and Patient Search process
- Selected patient ID and patient details between Patient Search and Medical Information Entry
- Medical data and validation results between Medical Information Entry and Visit Creation
- Visit ID and previous balance between Visit Creation and Financial Information Processing
- Payment data between Financial Information Processing and the Payments/Balances databases
- Visit summary from Visit Confirmation to Staff

This diagram illustrates the step-by-step process of creating a patient visit in the CitiMed system, from patient selection to final confirmation, showing how data flows between the different subprocesses and data stores.
