# php-errors-api

Like any other scripting language, PHP has two types of errors:

- syntax errors: language errors in your script that cause immediate failure. These errors cause script to exit immediately without going through a listenable shutdown phase. Thankfully though, they are easily dealt with by using a modern IDE (such as Eclipse) that highlights syntax errors.
- execution errors: errors that appear while a correctly written script is executed. PHP recognizes following types of execution errors:
	- fatal errors: self-handled errors causing script to exit, while a message is displayed and a log entry is recorded (eg: a non-existent method is called)
	- non-fatal errors: self-handled errors causing script to continue execution, while a message is displayed and a log entry is recorded (eg: a non-existent entry in an array is accessed)
	- exceptions: user-handled errors that can be manually thrown and handled
         
Ideally, errors should have thrown an exception able to be user-handled (to make the the whole process of error handling controllable from a single point), but up until version 7.0 users had to manually direct self-handled errors & uncaught exceptions to user-defined exceptions in order to achieve a single point of control for errors flow.  This functionality, primitive as it is, provides a hook for an AOP layer that non-destructively listens to application for cross-cutting concerns (errors), keeping all other components strictly dedicated to their purpose and oblivious of error handling. 

ErrorsAPI provides a thin layer of abstraction (skeleton) for unified error handling (redirecting all uncaught error to an errors' front controller). Its control point is the ErrorHandler class, able to register reporters (storage mediums in which error will be logged into) and renderer (entity that will perform response back to caller), then handle any exception by delegating to registered reporters and renderer. In order to handle PHP execution errors as well, API turns on reporting for all PHP errors then redirects them to a PHPException class, via native set_error_handler & register_shutdown_function. From that moment on, every PHP execution error will automatically throw a PHPException, which is then delegated to an ErrorHandler instance that must be registered beforehand.

More information here:<br/>
http://www.lucinda-framework.com/errors-api
