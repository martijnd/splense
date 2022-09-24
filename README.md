Event

-   users
-   expenses

User

-   expenses -> DebtorExpense -> Expense[]

DebtorExpense

-   user_id
-   expense_id
-   user
-   expense

Expense

-   event_id
-   user_id
-   name
-   amount

-   creditor -> User
-   debtors -> DebtorExpense -> User[]
-   event
