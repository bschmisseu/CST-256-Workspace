<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use App\model\User;
use App\business\SecurityService;
use App\Services\Utility\ILoggerService;

class TestLoggingController extends Controller
{
    protected $logger;
    
    public function __construct(ILoggerService $logger)
    {
        $this->logger = $logger;
    }
    
    public function index()
    {
        echo "In index()<br/>";
        $this->logger->info("Entering TestLoggingController.index()");
        echo "Out of index()";
    }
}
