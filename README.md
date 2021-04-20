## Shopping List Laravel Test Application

### Initial Setup
- Git clone the repo to your preferred directory destination ie `git clone git@github.com:RoussKS/shopping-app-laravel.git ~/shopping-app-laravel`
- Copy/Rename `.env.example` to `.env` and populate your preferred credentials for DB etc (APP_KEY is required, generated on a next step command).
- If running the app for the first time, run `./vendor/bin/sail build` in the app folder.
- Run `./vendor/bin/sail up -d` in the app folder.
- Run `./vendor/bin/sail composer install` in the app folder.
- Run `./vendor/bin/sail npm install` in the app folder.
- Run `./vendor/bin/sail npm run dev` in the app folder.
- Run `./vendor/bin/sail artisan key:generate` in the app folder to generate an APP key in your `.env` file.
- Run `./vendor/bin/sail artisan migrate:fresh --seed`.
    - Generates the necessary tables and seeds the database adding 3 random test users as long as `APP_ENV=local` in the `.env` file.
    - User 1: `email = user-1@mailinator.com`, `password = Password_001`
    - User 2: `email = user-2@mailinator.com`, `password = Password_002`
    - User 3: `email = user-3@mailinator.com`, `password = Password_003`
- Run `./vendor/bin/sail artisan up` in the app folder to start the app.

- Run `./vendor/bin/sail test` in the app folder to execute tests.

Make sure you execute the database refresh with seed after running tests to refresh the database for accessing the application via the browser.

### Allowed Actions
- Login (GET/POST), displays login screen and allows login action
- Logout
- Dashboard (GET), displays main app page for authenticated user & displays shopping list, shopping items & actions.
- Create (POST) a new Shopping List.
- Create (POST) a new Shopping Item.
- Update (PATCH) an existing Shopping Item to mark it as purchased.
- Delete (DELETE) an existing Shopping Item.

### Assumptions, Considerations
- The application was built using [Laravel PHP Framework](https://laravel.com).
- It is using [Laravel Sail](https://laravel.com/docs/8.x/sail) which is a command line interface & docker container environment for laravel.
- Each Model has a UUID which is used instead of standard Increment IDs as an additional security best practice.
- Extra time was taken in R&D & App setup and also while development in structuring the app. Tried to make it feel as less an MVP as possible.
- Services follow their respective Contract.
- Controllers were kept as thin as possible.
- Separate Request models per request type following Laravel & [RESTful](https://laravel.com/docs/8.x/controllers#resource-controllers) conventions.
- Leverages the framework's IoC for DI.
- Leverages the framework's [Route Model Binding](https://laravel.com/docs/8.x/routing#route-model-binding) feature (auto match a route by route key to a Model's route if found,this is using the Models UUID's).
- Leverages the framework's collections.
- Leverages the framework's [Request input validation](https://laravel.com/docs/8.x/validation#form-request-validation).
- Leverages the framework's [Request input validation](https://laravel.com/docs/8.x/validation#form-request-validation) & [Policies](https://laravel.com/docs/8.x/authorization#creating-policies) for each provided action/endpoint to handle authorization.
- Uses Input Models when creating/update a Model. This enforces a sort of contract for input to the system after request validation, instead of displaying the default model.
- Uses View Models when displaying Model data on the templates. This enforces a sort of contract for output, instead of displaying the default model.
- Documentation blocks & comments were created while developing as much as possible to allow for an easy read through the code.

### Limitations
- No Eager loading or Pagination is used at this stage. They should be used when collections start getting large in size to facilitate N+1 problems and better UI.
- Test suite is mostly around authenticating various user actions. Test suite should be enhanced, though a lot of actions are covered by native Framework code and tests.
- Passwords, keys & other sensitive data are currently stored in the Repo for quick setup and use, as this is a test application. That would not be the case for a real life example.
- Repositories should be used with conjuction with services to allow better de-association from the framework.
- Layout styling can be improved
