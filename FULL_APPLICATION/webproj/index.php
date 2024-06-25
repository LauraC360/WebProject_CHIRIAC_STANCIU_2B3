<?php

declare(strict_types=1);

//http://localhost/webproj/api/county/monthly-stats/galati/March/2024
//http://localhost/webproj/api/county/resources/galati


//http://localhost/webproj/api/county/files/galati/March/2024
//http://localhost/webproj/api/county/all/monthly-stats/March/2024

spl_autoload_register(function ($class) {
    require_once __DIR__ . "/config/$class.php";
});

$parts = explode('/', $_SERVER['REQUEST_URI']);
//var_dump($parts);

if ($parts[1] != "webproj") {
    http_response_code(404);
    exit;
}

if ($parts[2] != "api") {
    http_response_code(404);
    exit;
}

// echos just for testing purposes
$controllerName = $parts[3] ?? null;
if ($controllerName == "county") {
    //echo json_encode(['message' => 'County controller']);
    $controller = new CountyController;
    
    $requestType = $parts[4] ?? null;
    if($requestType == "resources") {
        //echo json_encode(['message' => 'County resources']);
        $county = $parts[5] ?? null;
        if (! $county) {
            // manually set it to galati
            $county = "galati";
        }
        if ($county) {
            //echo json_encode(['county' => $county]);
            $controller->processGetCountyDataRequest($_SERVER['REQUEST_METHOD'], $county);
        }
    }
    else if($requestType == "monthly-stats") {
        //echo json_encode(['message' => 'County monthly stats']);
        $county = $parts[5] ?? null;
        $month = $parts[6] ?? null;
        $year = $parts[7] ?? null;
        if ($county && $year && $month) {
            //echo json_encode(['county' => $county, 'year' => $year, 'month' => $month]);
            $controller->processGetCountyMonthlyStatsRequest($_SERVER['REQUEST_METHOD'], $county, $month, $year);
        }
    } else if($requestType == "files") {
        //echo json_encode(['message' => 'County files']);
        $format = $parts[5] ?? null;
        $month = $parts[6] ?? null;
        $year = $parts[7] ?? null;
        $county = $parts[8] ?? null;
        if ($format && $county && $year && $month) {
            //echo json_encode(['county' => $county, 'year' => $year, 'month' => $month]);
            $controller->processGetCountyFilesRequest($_SERVER['REQUEST_METHOD'], $format, $month, $year, $county);
        }
    } else if($requestType == "all") {
        //echo json_encode(['message' => 'County all']);
        $subtype = $parts[5] ?? null;
        if($subtype == "monthly-stats") {
            //echo json_encode(['message' => 'County all monthly stats']);
            $month = $parts[6] ?? null;
            $year = $parts[7] ?? null;
            if ($year && $month) {
                //echo json_encode(['year' => $year, 'month' => $month]);
                $controller->processGetAllCountiesMonthlyStatsRequest($_SERVER['REQUEST_METHOD'], $month, $year);
            }
        }
        else if($subtype == "files") {
            //echo json_encode(['message' => 'County all files']);
            $format = $parts[6] ?? null;
            $month = $parts[7] ?? null;
            $year = $parts[8] ?? null;
            if ($format && $year && $month) {
                //echo json_encode(['year' => $year, 'month' => $month]);
                $controller->processGetAllCountiesFilesRequest($_SERVER['REQUEST_METHOD'], $format, $month, $year);
            }
        }
        else if($subtype == "download") {
            //echo json_encode(['message' => 'County all download']);
            $format = $parts[6] ?? null;
            if ($format) {
                //echo json_encode(['year' => $year, 'month' => $month]);
                $controller->processDownloadMapRequest($_SERVER['REQUEST_METHOD'], $format);
            }
            //http://localhost/webproj/api/county/all/download/svg
            //http://localhost/webproj/api/county/all/download/png
        }
        else if($subtype == "admin") {
            //echo json_encode(['message' => 'County all admin']);
            $month = $parts[6] ?? null;
            $year = $parts[7] ?? null;
            if ($year && $month) {
                //echo json_encode(['year' => $year, 'month' => $month]);
                $controller->processAdminRequest($_SERVER['REQUEST_METHOD'], $month, $year);
            }
        }
    }
    else {
        http_response_code(404);
        exit;
    }
}
else if ($controllerName == "community-reports") {
    //echo json_encode(['message' => 'Welcome to the API']);
    $controller = new CommunityReportsController;
    $requestType = $parts[4] ?? null;
    if($requestType == "new") {
        //echo json_encode(['message' => 'Community reports new']);
        $controller->processRequest($_SERVER['REQUEST_METHOD']);
    } else if ($requestType == "admin") {
        //echo json_encode(['message' => 'Community reports admin']);
        $controller->processAdminRequest($_SERVER['REQUEST_METHOD']);
    }
    else {
        http_response_code(404);
        exit;
    }
} 
else if ($controllerName == "users") {
    $controller = new UserController;
    $requestType = $parts[4] ?? null;
    if ($requestType == "admin") {
        $controller->processAdminRequest($_SERVER['REQUEST_METHOD']);
    }
    else {
        http_response_code(404);
        exit;
    }   
}
else if ($controllerName == "home") {
    //echo json_encode(['message' => 'Welcome to the HOME API']);
    $controller = new PageController;
    $controller->serveHomePage($_SERVER['REQUEST_METHOD']);
}
// else if ($controllerName == "page") {
//     //echo json_encode(['message' => 'Welcome to the PAGE API']);
//     $pageName = $parts[4] ?? null;
//     $controller = new PageController;
//     if ($pageName == "home") {
//         $controller->serveHomePage();
//     } else {
//         http_response_code(404);
//         exit;
//     }
// }


else {
    http_response_code(404);
    exit;
}

// function serveCssIfExists($cssFile)
// {
//         // if (file_exists(__DIR__ . "/../public/style/Home/$cssFile")) {
//         //     header('Content-Type: text/css');
//         //     readfile(__DIR__ . "/../css/$cssFile");
//         // }

// }

?>