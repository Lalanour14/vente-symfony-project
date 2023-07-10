<?php

namespace App\Controller;

use App\Entity\Verre;
use App\Repository\VerreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/verre')]


/**
 * Summary of VerreController
 */
class VerreController extends AbstractController
{


    /**
     * Summary of __construct
     * @param \App\Repository\VerreRepository $repo
     */
    public function __construct(private VerreRepository $repo)
    {
    }

    #[Route(methods: 'GET')]

    /**
     * Summary of all
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function all(): JsonResponse
    {
        return $this->json($this->repo->findAll());
    }
    #[Route('/{id}', methods: 'GET')]
    public function one(int $id): JsonResponse
    {
        $verre = $this->repo->findById($id);
        if ($verre == null) {
            return $this->json('Resource Not found', 404);
        }

        return $this->json($verre);
    }
    #[Route('/{id}', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $verre = $this->repo->findById($id);
        if ($verre == null) {
            return $this->json('Resource Not found', 404);
        }
        $this->repo->delete($id);

        return $this->json(null, 204);
    }


    #[Route(methods: 'POST')]
    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        // $data = $request->toArray();
        // $verre = new Verre($data['genre'], $data['price']);

        try {

            $verre = $serializer->deserialize($request->getContent(), Verre::class, 'json');
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($verre);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->repo->persist($verre);

        return $this->json($verre, 201);
    }


    #[Route('/{id}', methods: 'PATCH')]
    public function update(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {

        $verre = $this->repo->findById($id);
        if ($verre == null) {
            return $this->json('Resource Not found', 404);
        }
        try {
            $serializer->deserialize($request->getContent(), verre::class, 'json', [
                'object_to_populate' => $verre
            ]);
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($verre);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->repo->update($verre);

        return $this->json($verre);
    }









}