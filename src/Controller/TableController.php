<?php

namespace App\Controller;

use App\Entity\Table;
use App\Form\TableType;
use App\Repository\TableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TableController extends AbstractController
{
    #[Route('/', name: 'app_table_index', methods: ['GET'])]
    public function index(TableRepository $tableRepository): Response
    {
        $tables = $tableRepository->findAll();
    
        return $this->render('table/index.html.twig', [
            'tables' => $tables,
        ]);
    }

    #[Route('/new', name: 'app_table_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $table = new Table();
        $form = $this->createForm(TableType::class, $table);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($table);
            $entityManager->flush();

            return $this->redirectToRoute('app_table_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('table/new.html.twig', [
            'table' => $table,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_table_show', methods: ['GET'])]
    public function show(Table $table): Response
    {
        $orders = $table->getOrders();
        return $this->render('table/show.html.twig', [
            'table' => $table,'orders' => $orders
        ]);
    }

    #[Route('/{id}/edit', name: 'app_table_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Table $table, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TableType::class, $table);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_table_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('table/edit.html.twig', [
            'table' => $table,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_table_delete', methods: ['POST'])]
    public function delete(Request $request, Table $table, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$table->getId(), $request->request->get('_token'))) {
            $entityManager->remove($table);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_table_index', [], Response::HTTP_SEE_OTHER);
    }
}
