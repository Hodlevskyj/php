<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    //створення продуктц
    #[Route('/items', name: 'create_item', methods: ['POST'])]
    public function create(Request $request, SessionInterface $session): Response
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['name'])) {
            return new Response('Invalid data', Response::HTTP_BAD_REQUEST);
        }
        //отрмамуємо продукти з сесії або ініціалізуємо порожній масив
        $products = $session->get('products', []);
        //створити продукт з полями id + name
        $item = [
            'id' => uniqid(),
            'name' => $data['name']
        ];

        //додаємо продукт в масив
        $products[] = $item;

        //зберігаємо оновлений масив у сесії
        $session->set('products', $products);
        return $this->json($item, Response::HTTP_CREATED);
    }

    //отримуємо всі продукти
    #[Route('/items', name: 'list_items', methods: ['GET'])]
    public function list(SessionInterface $session): Response
    {
        //отримуємо продукти з сесії
        $products = $session->get('products', []);

        return $this->json($products);
    }
    //оновлюємо продукт
    #[Route('/items/{id}', name: 'update_item', methods: ['PUT'])]
    public function update(Request $request, string $id, SessionInterface $session): Response
    {
        $data = json_decode($request->getContent(), true);
        $products = $session->get('products', []);

        foreach ($products as &$item) {
            if ($item['id'] === $id) {
                $item['name'] = $data['name'] ?? $item['name'];
                $session->set('products', $products); //зберігаємо оновлені продукти в сесії
                return $this->json($item);
            }
        }

        return new Response('Item not found', Response::HTTP_NOT_FOUND);
    }

    //видалення продукту
    #[Route('/items/{id}', name: 'delete_item', methods: ['DELETE'])]
    public function delete(string $id, SessionInterface $session): Response
    {
        $products = $session->get('products', []);

        foreach ($products as $key => $item) {
            if ($item['id'] === $id) {
                unset($products[$key]);
                $session->set('products', $products);//зберігаємо оновлені продукти в сесії
                return new Response('Item deleted', Response::HTTP_NO_CONTENT);
            }
        }

        return new Response('Item not found', Response::HTTP_NOT_FOUND);
    }
}
