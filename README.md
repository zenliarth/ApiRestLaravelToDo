Sure! Here are the steps formatted in Markdown:

# Project Setup Guide

1. **Download the project**:
   - Download the project files from the repository.
2. **Install dependencies**:
   - Run `composer install` to install PHP dependencies.
   - Run `npm install` to install JavaScript dependencies.
3. **Setup your database**:
   - Run `migrate fresh --seed` to set up the database and seed with initial data.
4. **Standard user**:
   - Use the following credentials for the standard user:
     - Email: team@team.com
     - Password: password
5. **Run the project**:
   - Execute `php artisan serve` to start the project.
6. **Routes**:
   - Register:
     - Route: `/api/register`
   - Login:
     - Route: `/api/login`
   - Logout:
     - Route: `/api/logout`
   - To use the API, you should be logged in.
7. **Get the token**:
   - Retrieve the token after successful login to make API requests.
8. **Tasks**:
   - Create:
     - Route: `/api/v1/tasks`
     - Method: POST
     - Required:
       ```json
       {
         "title": "New Task",
         "description": "New Task from API."
       }
       ```
   - Update:
     - Route: `/api/v1/tasks/{task}`
     - Method: POST
     - Required:
       ```json
       {
         "title": "Task From API Updated",
         "description": "This is a description for my task updated."
       }
       ```
   - Delete:
     - Route: `/api/v1/tasks/{task}`
     - Method: DELETE
   - Retrieve all tasks for the logged user:
     - Route: `/api/v1/tasks`
     - Method: GET
   - Retrieve a specific task:
     - Route: `/api/v1/tasks/{task}`
     - Method: GET
   - Mark task as completed:
     - Route: `/api/v1/tasks/{task}/complete`
     - Method: PATCH
   - Create an attachment for a task:
     - Route: `/api/v1/tasks/{task}/attachments`
     - Method: POST
   - Delete an attachment for a task:
     - Route: `/api/v1/attachments/{attachment}`

Make sure to follow these steps and use the provided routes and instructions to interact with the API.
