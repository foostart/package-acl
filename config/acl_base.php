<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Application name
  |--------------------------------------------------------------------------
  |
  | The name of the application: this name will be used as title and as header
  | in the application
  |
  */

  "app_name" => "Package Acl",

  /*
  |--------------------------------------------------------------------------
  | Email confirmation
  |--------------------------------------------------------------------------
  |
  | Set this flag to true if you want to force every new user (on signup)
  | to verify his email address
  |
  */

  "email_confirmation" => true,

  /*
  |--------------------------------------------------------------------------
  | Gracefully error handling
  |--------------------------------------------------------------------------
  |
  | Set this flag to true if you want the application to handle 404 and 401
  | error pages
  |
  */

  "handle_errors" => true,

  /*
  |--------------------------------------------------------------------------
  | Login redirection url
  |--------------------------------------------------------------------------
  |
  | The user/login redirection url
  |
  */
  "user_login_redirect_url" => "/",

    /*
  |--------------------------------------------------------------------------
  | Admin login redirection url
  |--------------------------------------------------------------------------
  |
  | The admin login redirection url
  |
  */
   "admin_login_redirect_url" => "/admin/users/dashboard",

  /*
  |--------------------------------------------------------------------------
  | User per page
  |--------------------------------------------------------------------------
  |
  | Set the number of users per page to show on admin users list page
  |
  */

  "users_per_page" => 15,

  /*
  |--------------------------------------------------------------------------
  | Groups per page
  |--------------------------------------------------------------------------
  |
  | Set the number of groups per page to show on admin groups list page
  |
  */

  "groups_per_page" => 15,

  /*
  |--------------------------------------------------------------------------
  | Permissions per page
  |--------------------------------------------------------------------------
  |
  | Set the number of permissions per page to show on admin groups list page
  |
  */

  "permissions_per_page" => 15,

    /*
   |--------------------------------------------------------------------------
   | Captcha validation on signup
   |--------------------------------------------------------------------------
   |
   | Flag to enable/disable captcha validation on user signup
   |
   */

  "captcha_signup" => TRUE,
  "captcha_login" => FALSE,

  /*
   |--------------------------------------------------------------------------
   | Avatar
   |--------------------------------------------------------------------------
   */
  "default_avatar_path" => '/packages/foostart/images/avatar.png',
  /*
   * Set to true if you want to use the user gravatar instead
   */
  "use_gravatar" => false,
];