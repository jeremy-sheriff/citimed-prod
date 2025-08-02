# Context-Level Data Flow Diagram (Level 0)

```
+----------------+                                  +----------------+
|                |                                  |                |
|                |  Login/Authentication            |                |
|                | -------------------------->      |                |
|                |                                  |                |
|                |  Access Control                  |                |
|                | <--------------------------      |                |
|                |                                  |                |
|   System       |  Patient Data                    |    Users      |
|   Users        | -------------------------->      |    (Staff)     |
|   (Staff)      |                                  |                |
|                |  Patient Records                 |                |
|                | <--------------------------      |                |
|                |                                  |                |
|                |  Visit/Medical Data              |                |
|                | -------------------------->      |                |
|                |                                  |                |
|                |  Reports/Summaries              |                |
|                | <--------------------------      |                |
+----------------+                                  +----------------+
        ^                                                  ^
        |                                                  |
        |                                                  |
        v                                                  v
+----------------+                                  +----------------+
|                |                                  |                |
|                |  Personal Information            |                |
|                | -------------------------->      |                |
|                |                                  |                |
|                |  Medical Services                |                |
|   Patients     | <--------------------------      |    CitiMed     |
|                |                                  |    System      |
|                |  Payment Information             |                |
|                | -------------------------->      |                |
|                |                                  |                |
|                |  Receipts/Invoices              |                |
|                | <--------------------------      |                |
|                |                                  |                |
+----------------+                                  +----------------+
        ^                                                  ^
        |                                                  |
        |                                                  |
        v                                                  v
+----------------+                                  
|                |  Payment Transactions            
|                | -------------------------->      
|                |                                  
|   Payment      |  Transaction Confirmations       
|   Systems      | <--------------------------      
|                |                                  
+----------------+                                  
```

## Description

This context-level (Level 0) Data Flow Diagram shows the CitiMed system and its interactions with three main external entities:

1. **System Users (Staff)** - Healthcare professionals and administrative staff who interact with the system, including doctors, nurses, lab technicians, pharmacists, receptionists, finance officers, inventory managers, and HR officers.

2. **Patients** - Individuals receiving medical care who provide personal information and payments, and receive medical services and receipts/invoices.

3. **Payment Systems** - External payment processing systems like cash handling, M-Pesa, bank transfers, or insurance systems that process payment transactions and provide confirmation.

The diagram shows the high-level data flows between these entities and the CitiMed system without detailing the internal processes of the system itself.
