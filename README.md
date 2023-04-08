#Requirements
- Docker
- WSL (windows)

## Steps
- Clone this repo
- Run `php artisan sail:install`
    - Select postgress and hit enter
- run `./vendor/bin/sail up -d`
- run `php artisan migrate` to setup the database
- Goto Localhost and check if the site is working, It should be a laravel welcome page.
- Click Register From there.
- Checkout the various themes (icon in top right corner)
- Make a blog, update your avatar image from  profile management (your name in the top right corner)


## API
- I've created 4 API endpoints
    - `localhost/api/posts` 
    - `localhost/api/posts/{id}` 
    - `localhost/api/tags` 
    - `localhost/api/tags/{id}` 
- Test them with post man
- Integrate with Front end
