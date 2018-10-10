<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\getLastAuthenticationError;
use Symfony\Component\Security\Http\Authentication\getLastUsername;
use Symfony\Component\Ldap\Ldap;
use Symfony\Component\HttpFoundation\Response;



class LoginController extends Controller
{

    /**
     * @Route("/usuarios/login" , name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationutils)
    {  
        
 

        
        $errors       = $authenticationutils->getLastAuthenticationError();
        $lastusername = $authenticationutils->getLastUsername();
        
      
        return $this->render('@App/login/login.html.twig', array(
            'errors'       => $errors,
            'lastusername' => $lastusername,

        ));
    }


    /**
     * @Route("/pepe" , name="pepe")
     */
    public function pepeAction()
    {  
        
        $ldap = Ldap::create('ext_ldap', array('connection_string' => 'ldap://MAGYP-DC01.MAGYP.AR'));
        //$ldap2 = Ldap::create('ext_ldap', array('connection_string' => MAGYP-DC01.MAGYP.AR));
        $username='MAGYP\gchiappe';
       
        $password= 'aLTA2036';

         $ldap->bind($username , $password);

     /*   $entryManager = $ldap->getEntryManager();
        dump( $ldap);
        dump( $entryManager );*/






           
//OU=Magyp Usuarios
        $query = $ldap->query('OU=Magyp Usuarios,dc=MAGYP,dc=AR', '(&(objectclass=user)(samaccountname=mestrada))');
        $results = $query->execute()->toArray();
        dump($results);

        
       
        
      
       return new Response('<html><body>Admin page!</body></html>');
    }




}
