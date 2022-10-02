Event

-   title
-   user_id
-   closed_at

-   expenses
-   creator
-   users
-   invitedUsers

User

-   name
-   email

-   events
-   (expenses -> ExpenseUser -> Expense[])

ExpenseUser

-   user_id
-   expense_id
-   user
-   expense

Expense

-   event_id
-   user_id
-   name
-   amount

-   payer -> User
-   users -> ExpenseUser -> User[]
-   event
