<?php

namespace App\Controller;

use App\Entity\Odre;
use App\Repository\OdreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;




#[Route('/api/odre')]


/**
 * Summary of VerreController
 */
class VerreController extends AbstractController
{


    /**
     * Summary of __construct
     * @param \App\Repository\VerreRepository $repo
     */
    public function __construct(private OdreRepository $repo)
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
        // $verre = new Odre(new\DateTime (), $data['customName'],$data['id_monture]);

        try {

            $odre = $serializer->deserialize($request->getContent(), Odre::class, 'json');
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($odre);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->repo->persist($odre);

        return $this->json($odre, 201);
    }


    #[Route('/{id}', methods: 'PATCH')]
    public function update(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator)
    {

        $odre = $this->repo->findById($id);
        if ($odre == null) {
            return $this->json('Resource Not found', 404);
        }
        try {
            $serializer->deserialize($request->getContent(), odre::class, 'json', [
                'object_to_populate' => $odre
            ]);
        } catch (\Exception $error) {
            return $this->json('Invalid body', 400);
        }
        $errors = $validator->validate($odre);
        if ($errors->count() > 0) {
            return $this->json(['errors' => $errors], 400);
        }
        $this->repo->update($odre);

        return $this->json($odre);
    }









}