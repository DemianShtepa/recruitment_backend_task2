<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\TimeInfoType;
use Domain\Time\TimeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TimeController extends AbstractController
{
    /**
     * @Route("/time", name="app_time_form", methods={"GET"})
     */
    public function index(): Response
    {
        $form = $this->createForm(TimeInfoType::class);

        return $this->render('time/form.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/time", name="app_time_info", methods={"POST"})
     */
    public function show(Request $request, TimeService $timeService): Response
    {
        $form = $this->createForm(TimeInfoType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            /** @var \DateTime $date */
            $date = $data['date'];
            $timeZone = (string)$data['timezone'];

            $timeInfo = $timeService->getInfo($date, $timeZone);

            return $this->render('time/info.html.twig', ['timeInfo' => $timeInfo]);
        }

        return $this->render('time/form.html.twig', ['errors' => $form->getErrors()]);
    }
}
