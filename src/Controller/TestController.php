<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/item')]
class TestController extends AbstractController
{
    public array $items=[];
    #[Route('/get', name: 'app_item_get',methods:["GET"])]
    public function get(Request $request): JsonResponse
    {
        // return $this->render('test/index.html.twig', [
        //     'controller_name' => 'TestController',
        // ]);
//        $queryParams = $request->query->all();
        // $data=['sf','rer','dsf'];
//        return new JsonResponse($queryParams,200);
//        return  new JsonResponse($this->items,200);
        $queryParams = $request->query->all();
        return new JsonResponse($queryParams, 200);
    }


    #[Route('/post', name: 'app_item_post',methods:["POST"])]
    public function post(Request $request): JsonResponse
    {
        // return $this->render('test/index.html.twig', [
        //     'controller_name' => 'TestController',
        // ]);
        // getContent()
//        $requestParams = $request->request->all();
        // $data=['sf','rer','dsf'];
//        return new JsonResponse($requestParams);
        $requestBody=json_decode($request->getContent(), true);
        return new JsonResponse($requestBody, 200);
    }

    #[Route('/get-item/{id}', name: 'app_get_item',methods:["GET"])]
    public function getItem(string $id): JsonResponse
    {

        return new JsonResponse($id, 200);
    }

}
