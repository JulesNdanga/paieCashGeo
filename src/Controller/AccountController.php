<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
   

    
    
    /**
     * @Route("/compte", name="account")
     */
    public function index(): Response
    {
        $user = new User();
        $resellers = $this->getDoctrine()->getRepository(User::class)->findBy(['country'=>$user->getCountry(),'type'=> 'reseller'], ['id' => 'desc']);

        return $this->render('account/index.html.twig',[
            'resellers' => $resellers

        ]);
    }
    
    /**
     * resellers_near_me
     *
     * @param  mixed $distance
     * @param  mixed $country1
     * @param  mixed $country2
     * @return string
     */
    function resellers_near_me($distance, $country1, $country2)
    {
        
        if ($distance <= 10 && $country1 == $country2 ) {
            return "Le revendeurs le plus proche est à ". $distance . "Km";
        }
    }
    /**
     * distance
     *
     * @param  mixed $lat1
     * @param  mixed $lon1
     * @param  mixed $lat2
     * @param  mixed $lon2
     * @return float
     */
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return (float) ($miles * 1.609344); // Km
    }

    
}
