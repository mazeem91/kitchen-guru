# Kitchen Guru API - Laravel Base

## Requirements
- Git
- Unused Port `80`.
- Docker, Docker Compose

## Local Development Environment Setup 
- Clone this repository.
- Run `start.sh` which will:
    - leverage Laravel's `Sail` CLI to setup all the required docker services and application dependencies.
    - Fetch the `.env` file for the local development project.
    - Start all the required docker containers via sail.
    - Run the DB migrations.
- Run `./vendor/bin/sail artisan db:seed` To Seed the DB.

## API Usage.
- Visit http://localhost/api/documentation and check the documented APIs.
- Generate JWT for `test` user via :
    - email : `test@example.com`
    - password : `password`
    - device_name : `phone`
- Use the generated JWT as Authorization for your requests. 
- Run `./vendor/bin/sail down` To stop all services.

