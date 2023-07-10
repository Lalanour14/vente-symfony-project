<?php

namespace App\Controller;

use App\Entity\Ordre;
use App\Repository\OrdreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;




#[Route('/api/ordre')]
class OrdreController extends AbstractController
{



    public function __construct(private OrdreRepository $repo)
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
        $ordre = $this->repo->findById($id);
        if ($ordre == null) {
            return $this->json('Resource Not found', 404);
        }

        return $this->json($ordre);
    }
    #[Route('/{id}', methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $ordre = $this->repo->findById($id);
        if ($ordre == null) {
            return $this->json('Resource Not found', 404);
        }
        $this->repo->delete($id);

        return $this->json(null, 204);
    }


    #[Route(methods: 'POST')]
    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        // $data = $request->toArray();
        // $ordre = new Odre(new\DateTime (), $data['customName'],$data['id_monture]);

        try {

            $ordre = $serializer->deserialize($request->getContent(), Ordre::class, 'json');
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($ordre);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->repo->persist($ordre);

        return $this->json($ordre, 201);
    }


    #[Route('/{id}', methods: 'PATCH')]
    public function update(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {

        $ordre = $this->repo->findById($id);
        if ($ordre == null) {
            return $this->json('Resource Not found', 404);
        }
        try {
            $serializer->deserialize($request->getContent(), Ordre::class, 'json', [
                'object_to_populate' => $ordre
            ]);
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($ordre);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->repo->update($ordre);

        return $this->json($ordre);
    }









}