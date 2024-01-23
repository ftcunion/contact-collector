# Number Drop

This is an extremely minimal web form written in PHP that people can use to provide their phone numbers. The numbers are stored in a text file called `numbers` in the same directory. This is intended to be used with a shared hosting service, but self-hosting is straightforward if you have a web server with PHP installed. In either case, just drop it into a folder on your web server and it should work.

This repository includes a `.htaccess` file which denies public access to the `numbers` file. This only works on Apache servers which have `.htaccess` enabled. Most shared hosting providers enable this feature. If you are using a different web server, you will need to find a different way to protect the `numbers` file. If you want the numbers to be public, you can remove the `.htaccess` file. You may also prefer to use basic web authentication instead of denying all access to the file.
