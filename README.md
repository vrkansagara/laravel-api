# laravel-api

Laravel as API layer

Resonse Type 
- [x] JSON
    - Currently suppoted
- [] JSONP
- [] HAL JSON
- [] XML


 ## Third party library

- [x] Adding package manger security using Roave Security Advisories
- [x] Adding coding standard from Zend Framework Coding Standard
- [x] Adding Role-based-access-control (RBAC) 
- [x] Adding Log activity
- [x] Adding response header security using CORS headers
- [x] Adding log viewer
- [x] Adding Google Analytics package for retriving analytics data
- [x] Adding setting repository
- [x] Adding Laravel Flysystem for multipal backup on  (AwsS3, Azure, Dropbox, GridFS, Rackspace, Sftp, WebDav, ZipAdapter)
- [x] Adding LERN (Laravel Exception Recorder and Notifier)
- [x] Adding redis library (Flexible and feature-complete Redis client for PHP and HHVM)
- [x] Adding faker for fake database generation
- [x] Adding Laravel Repositories Pattern  
- [x] Adding laravel passport for tokenizer
- [x] Adding Laravel Cashier for maintain payment(s).
- [x] Adding laravel event broadcasting
- [x] Adding larvel debug bar for live debug log on view side.
- [x] Adding larvel telescope for the debugging purpose ( requests , exceptions, log entries, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, variable dumps and more )
- [x] Adding Laravel Socialite for social auth ( Facebook, Twitter, LinkedIn, Google, GitHub and Bitbucket. ) 



## TODO 
- [] Custom template for the api response

# Special thanks

Thanks to all of third party library provider. 

# API formate

`JSON Response`


Success  template
~~~JSON

{
    status: 1,
    message: "This is success message for client",
    errorCode:100
    data:"data can be array or array of object",
}
~~~

Error  template

~~~JSON

{
    status: 0,
    message: "This is error message for client",
    errorCode:301
    data:"data can be array or array of object",
}
~~~

`status` value must be either `0` or `1`

`message` value must be array.

`errorCode` value must be integer.

`data` would be any kind of response


### Reserved code for the respose format

`errorCode` has reserved value from 0 to 999.

0 to 99  for application use
100 to 599 used as HTTP status code
600 to 999 used for tcp/udp protocol



# General Assemption

Project accept follwing headers
- application/json
- application/xml
