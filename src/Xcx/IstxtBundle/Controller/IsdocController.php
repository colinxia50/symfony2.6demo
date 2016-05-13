<?php

namespace Xcx\IstxtBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Xcx\IstxtBundle\Entity\Isdoc;
use Xcx\IstxtBundle\Form\IsdocType;

/**
 * Isdoc controller.
 *
 */
class IsdocController extends Controller
{

    /**
     * Lists all Isdoc entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
 
        $categories = $em->getRepository('XcxIstxtBundle:Category')->getWithIsdoc();
 
        foreach($categories as $category) {
            $category->setActiveJobs($em->getRepository('XcxIstxtBundle:Isdoc')->getActiveIsdoc($category->getId(),
                $this->container->getParameter('max_txt_on_homepage')));
        }
// dump($categories);
 //exit;
        return $this->render('XcxIstxtBundle:Isdoc:index.html.twig', array(
            'categories' => $categories
        ));
        
    }
    /**
     * Creates a new Isdoc entity.
     *
     */
    public function createAction(Request $request)
    {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            //$request_cont = $request->getContent();
            // get raw json data
            $category_id =  $request->request->get('category_id');
            $position =  $request->request->get('position');
            $description =  $request->request->get('description');
            $product = new Isdoc();
            $product->setCategoryId($category_id);
            $product->setCategory();
            $product->setPosition($position);
            $product->setDescription($description);
            $product->setIsPublic('1');
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($product);
            $em->flush();

            return new JsonResponse(array('msg'=>'ok'));
        }else {
            return $this->redirect($this->generateUrl('xcx_istxt_homepage'));
        }
    }
    /**
     * Creates a form to create a Isdoc entity.
     *
     * @param Isdoc $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Isdoc $entity)
    {
        $form = $this->createForm(new IsdocType(), $entity, array(
            'action' => $this->generateUrl('xcx_isdoc_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Isdoc entity.
     *
     */
    public function newAction()
    {
        $entity = new Isdoc();
        $form   = $this->createCreateForm($entity);

        return $this->render('XcxIstxtBundle:Isdoc:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to get a  Isdoc entity.
     *
     */
    public function ajaxgetAction()
    {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $request_cont = $request->getContent();
           // get raw json data
        $pid =  $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('XcxIstxtBundle:Isdoc')->findBy(array(),array(),3,$pid);
        //$entities = $em->getRepository('XcxIstxtBundle:Isdoc')->find($pid);
        $em->flush();
        //dump($entities);
        //exit;
        //$arrq = json_encode($entities);
        //dump($arrq);
        //$arr = array ('a'=>'什么都不懂还','b'=>2,'c'=>3,'d'=>4,'e'=>5);
        //dump($arr);
          if ($entities) {
                return new Response(json_encode(array('doc'=>$entities)));
              // return new JsonResponse(array('name'=>$entities));
              //$response = new Response(json_encode(array('name' => $entities)));
             // $response->headers->set('Content-Type', 'application/json');
              
                 
           }else {
               return new JsonResponse(array('name2'=>$entities));
           } 
        
        }else {
            return $this->redirect($this->generateUrl('xcx_istxt_homepage'));
        }
    }

    /**
     * Finds and displays a Isdoc entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('XcxIstxtBundle:Isdoc')->getActiveIstxtk($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Isdoc entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('XcxIstxtBundle:Isdoc:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Isdoc entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('XcxIstxtBundle:Isdoc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Isdoc entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('XcxIstxtBundle:Isdoc:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Isdoc entity.
    *
    * @param Isdoc $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Isdoc $entity)
    {
        $form = $this->createForm(new IsdocType(), $entity, array(
            'action' => $this->generateUrl('xcx_isdoc_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Isdoc entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('XcxIstxtBundle:Isdoc')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Isdoc entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('xcx_isdoc_edit', array('id' => $id)));
        }

        return $this->render('XcxIstxtBundle:Isdoc:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Isdoc entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('XcxIstxtBundle:Isdoc')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Isdoc entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('xcx_isdoc'));
    }

    /**
     * Creates a form to delete a Isdoc entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('xcx_isdoc_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
