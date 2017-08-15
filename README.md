# SecurityPractices
Practicing security implementations using JWT
This is a project developed to demonestrate the use of token based security practice. I used Firebase libraries to use JWT along with PHP. I created two pages the first one is InsertRecords.php which posts data into the database and the other one is GetRecords.php which brings the data from the database. I mentioned everything in the comments. The Composer file is used to generatre the libraries and the vendor folder has all the library files.

How do JSON Web Tokens work?
In authentication, when the user successfully logs in using their credentials, a JSON Web Token will be returned and must be saved locally (typically in local storage, but cookies can be also used), instead of the traditional approach of creating a session in the server and returning a cookie.

This is a stateless authentication mechanism as the user state is never saved in server memory. The server's protected routes will check for a valid JWT in the Authorization header, and if it's present, the user will be allowed to access protected resources. As JWTs are self-contained, all the necessary information is there, reducing the need to query the database multiple times.

This allows you to fully rely on data APIs that are stateless and even make requests to downstream services. It doesn't matter which domains are serving your APIs, so Cross-Origin Resource Sharing (CORS) won't be an issue as it doesn't use cookies.


