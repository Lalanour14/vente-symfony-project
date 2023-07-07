<?php

namespace App\Controller;

use App\Entity\Monture;
use App\Repository\MontureRepository;
use App\Service\Uploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/monture')]
/**
 * Summary of MontureController
 */
class MontureController extends AbstractController
{

    /**
     * Summary of __construct
     * @param \App\Repository\MontureRepository $repo
     */
    public function __construct(private MontureRepository $repo)
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
        $monture = $this->repo->findById($id);
        if ($monture == null) {
            return $this->json('Resource Not found', 404);
        }

        return $this->json($monture);
    }
    #[Route('/{id}', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $monture = $this->repo->findById($id);
        if ($monture == null) {
            return $this->json('Resource Not found', 404);
        }
        $this->repo->delete($id);

        return $this->json(null, 204);
    }

    #[Route(methods: 'POST')]



    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, Uploader $uploader)
    {
        //$data = $request->toArray();
        //$monture = new Monture($data['marque'], $data['model'], $data['basePrice'] $data['picture']);
        try {

            $monture = $serializer->deserialize($request->getContent(), Monture::class, 'json');
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($monture);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        if ($monture->getPicture()) {

            $filename = $uploader->upload($monture->getPicture());
            $monture->setPicture($filename);
        }
        $this->repo->persist($monture);

        return $this->json($monture, 201);
    }


    #[Route('/{id}', methods: 'PATCH')]
    public function update(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {

        $monture = $this->repo->findById($id);
        if ($monture == null) {
            return $this->json('Resource Not found', 404);
        }
        try {
            $serializer->deserialize($request->getContent(), monture::class, 'json', [
                'object_to_populate' => $monture
            ]);
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($monture);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->repo->update($monture);

        return $this->json($monture);
    }
}