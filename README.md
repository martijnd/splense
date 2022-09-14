Event

-   users
-   expenses

User

-   expenses

DebtorExpense

-   user_id
-   expense_id
-   user
-   expense

Expense

-   event_id
-   user_id
-   creditor -> User
-   debtors -> DebtorExpense -> User[]
-   event
