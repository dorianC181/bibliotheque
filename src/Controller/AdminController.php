<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_ADMIN', message: 'Access denied: You must have admin privileges.', statusCode: 403)]
class AdminController extends AbstractController
{

    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function adminDashboard(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/super-dashboard', name: 'admin_super_dashboard')]
    #[IsGranted('ROLE_SUPER_ADMIN', message: 'You are not allowed to access the admin dashboard.')]
    public function superAdminDashboard(): Response
    {
        return $this->render('admin/super_dashboard.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/reports', name: 'admin_reports')]
    #[IsGranted('ROLE_ADMIN', statusCode: 423)]
    public function adminReports(): Response
    {
        return $this->render('admin/reports.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/logs', name: 'admin_logs')]
    #[IsGranted('ROLE_ADMIN', statusCode: 403, exceptionCode: 10010)]
    public function adminLogs(): Response
    {
        return $this->render('admin/logs.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
