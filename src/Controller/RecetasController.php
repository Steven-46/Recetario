<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Recetas;
use App\Form\RecetasType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class RecetasController extends AbstractController
{
    /**
     * @Route("/recetas", name="recetas")
     */
    public function index(Request $request): Response
    {
        $receta = new Recetas();
        $form = $this->createForm(RecetasType::class, $receta);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $brochureFile = $form->get('imagen')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception('Ups! ha ocurrido un error');
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $receta->setImagen($newFilename);
            }
            $user = $this->getUser();
            $receta->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($receta);
            $em->flush();
            $query = $em->getRepository(Recetas::class)->BuscarTodasLasRecetas();
            return $this->redirectToRoute('recetas');

        }
        return $this->render('recetas/index.html.twig', [
            'formulario' => $form->createView(),
        ]);
    }

    /**
     * @Route("/receta/{id}", name="editRecetas")
     */
    public function EditReceta($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $recetas = $em->getRepository(Recetas::class)->find($id);
        $receta = new Recetas();
        $form = $this->createForm(RecetasType::class, $receta);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $user = $this->getUser();
            $receta->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($receta);
            $em->flush();
            $query = $em->getRepository(Recetas::class)->EditarReceta($id);
            return $this->redirectToRoute('recetas');

        }
        return $this->render('recetas/editReceta.html.twig', [
            'formulario' => $form->createView(),
            'receta'=>$recetas
        ]);
    }



}
