<?php

namespace Email\EmailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Email\EmailBundle\Entity\Users;


class DefaultController extends Controller
{
 public function indexAction(Request $request)
    {
        
       if (isset($_POST['eksportuoti'])) {
           
           
        //$con = $this->getDoctrine()->getManager()->getConnection();
       // $stmt = $con->executeQuery('SELECT user_name FROM users');
       // foreach ($stmt->fetchAll() as $row){
       // print_r($row);
      //  }
       //----------------------------------     
        
        $con = $this->getDoctrine()->getManager()->getConnection();
        $stmt = $con->executeQuery('SELECT user_name FROM users ORDER BY id DESC'); 
        foreach ($stmt->fetchAll() as $row){
        print_r($row);
        
        }
        
        }

        if (isset($_POST['tikrinti']))   {
 
       
            
            $string = $request->get('username');
            $pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';
            $res = preg_match_all($pattern, $string, $matches);
            //var_export($matches);
            
       
        if ($res) { 
         
              
            
            foreach(array_unique($matches[0]) as $email) {
            //.echo $email . "<br />";
            //  $username = $request->get('$email');
            $user = new Users();
            $user->setUserName($email);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
           
            return $this->render('EmailEmailBundle:Default:index.html.twig', array('name' => 'Rasti El. pašto adresai,  adresai buvo įraukti į duomenų bazę. ' )); 

            }   
            
        }
       
        else{   
            
            
            //$total_count = $this->getTotal();
          // print_r($total_count);
          // die();
            
            
            return $this->render('EmailEmailBundle:Default:index.html.twig',array('name' => 'Įrašytame tekste el. pašto adresų nerasta.' ));
        }
    }
   return $this->render('EmailEmailBundle:Default:index.html.twig');
}

//Get database table.
    public function getTotal() {
        $em = $this->getDoctrine()->getEntityManager(); 
        $countQuery = $em->createQueryBuilder()
                ->select('c')
                ->from('EmailEmailBundle:Users', 'c');
      $finalQuery = $countQuery->getQuery();
      $total = $finalQuery->getSingleScalarResult();
      return $total;
}


    
    public function signupAction(Request $request) {
        if ($request->getMethod() == 'POST') {
            $username = $request->get('username'); 
            $user = new Users();
            
            $user->setUserName($username);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
             $em->flush();
            
        }
          return $this->render('EmailEmailBundle:Default:signup.html.twig');
    }

}
