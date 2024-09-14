<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test_get',methods:["GET"])]
    public function get(Request $request): JsonResponse
    {
        // return $this->render('test/index.html.twig', [
        //     'controller_name' => 'TestController',
        // ]);
        $queryParams = $request->query->all();
        // $data=['sf','rer','dsf'];
        return new JsonResponse($queryParams,200);
    }


    #[Route('/test-post', name: 'app_test_post',methods:["POST"])]
    public function post(Request $request): JsonResponse
    {
        // return $this->render('test/index.html.twig', [
        //     'controller_name' => 'TestController',
        // ]);
        // getContent()
        $requestParams = $request->request->all();
        // $data=['sf','rer','dsf'];
        return new JsonResponse($requestParams);
    }
}
