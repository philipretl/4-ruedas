<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\FailLoginException;
use Spatie\Permission\Exceptions\UnauthorizedException as UnauthorizedRolException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Venoudev\Results\Exceptions\CheckDataException;
use Venoudev\Results\Exceptions\NotFoundException;
use Venoudev\Results\Exceptions\UnauthorizedPassportException;

use ResultManager;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        $this->renderable(function(UnauthorizedRolException $e, $request){
            $result= ResultManager::createResult();
            $result->fail();
            $result->setCode(403);
            $result->addMessage('FORBIDDEN','You don\'t have rol or permission for this action');
            $result->addError('ROL_PERMISSION','Rol or permission incorrectly');
            $result->setDescription('Exist conflict with your rol or permission, please check the errors or messages.');
            return $result->getJsonResponse();
        });


        $this->renderable(function(NotFoundHttpException $e, $request){
            $result= ResultManager::createResult();
            $result->fail();
            $result->setCode(404);
            $result->addError('ROUTE_NOT_FOUND','Invalid route');
            $result->setDescription('This is posible because your route is incorrectly');
            return $result->getJsonResponse();
        });

        $this->renderable(function(MethodNotAllowedHttpException $e, $request){

            $result= ResultManager::createResult();
            $result->fail();
            $result->setCode(405);
            $result->addError('VERB_HTTP_INVALID','The verb or method http is not allowed for the server');
            $result->addMessage('CHECK_ROUTE','The route requested could be incorrectly ');
            $result->addMessage('CHECK_VERB','The verb or method http could be incorrectly, remember check the api documentation or check if your verb o method http is [GET, POST, PUT, DELETE]');
            $result->setDescription('this is posible because your method or verb http is incorrectly for the route requested');
            return $result->getJsonResponse();
        });
        $this->renderable(function(CheckDataException $e, $request){
            return $e->getJsonResponse();
        });

        $this->renderable(function(NotFoundException $e, $request){
            return $e->getJsonResponse();
        });

        $this->renderable(function(FailLoginException $e, $request){
            return $e->getJsonResponse();
        });

        $this->renderable(function(AuthenticationException $e, $request){
            $exception_internal = new UnauthorizedPassportException();
            return $exception_internal->getJsonResponse();
        });

    }
}
