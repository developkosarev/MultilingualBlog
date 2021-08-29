<?php

namespace App\Controller;

use Aws\S3\S3Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/document")
 */
class DocumentController extends AbstractController
{
    /**
     * @Route("/{id}", name="document_show", methods={"GET"})
     * @param Request $request
     * @param S3Client $s3Client
     * @return Response
     */
    public function show(S3Client $s3Client)
    {
        $s3BucketName = 'dev.dkdev.info';
        $key = 'mountains-4933524.jpg';

        $disposition = HeaderUtils::makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'myImage.jpg'
        );

        $command = $s3Client->getCommand('GetObject', [
            'Bucket' => $s3BucketName,
            'Key' => $key,
            'ResponseContentType' => 'application/octet-stream',
            'ResponseContentDisposition' => $disposition,
        ]);
        $request = $s3Client->createPresignedRequest($command, '+10 minutes');

        return new RedirectResponse((string) $request->getUri());


        //$document = 'test';

        //return $this->render('document/show.html.twig', [
        //    'document' => $document,
        //    'request' => $request
        //]);
    }
}
