<?php

namespace App\Controllers\Admin;

use App\Controllers\AbstractController;
use App\Models\User as DataModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserAdminController extends AbstractController
{
    /**
     * Named path for routing.
     *
     * @var string
     */
    protected $path = 'admin-users';

    /**
     * View for rendering.
     *
     * @var string
     */
    protected $view = 'admin/users.twig';

    /**
     * Name of the field for sorting and reporting in flash messages.
     *
     * @var string
     */
    protected $name_field = 'email';

    /**
     * Form submit button name to check for flow control.
     * Assumes values of 'create', 'update', 'delete'.
     *
     * @var string
     */
    protected $submit_name = 'submit';

    /**
     * Main manager page.
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return mixed
     */
    public function index(Request $request, Response $response, $args)
    {
        return $this->c->view->render($response, $this->view, [
            'edit'     => null,
            'data'     => null,
            'all_rows' => DataModel::orderBy($this->name_field)->get(),
        ]);
    }

    /**
     * Edit mode page.
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return mixed
     */
    public function edit(Request $request, Response $response, $args)
    {
        $edit = DataModel::find($args['id']);
        if (!$edit) {
            $this->c->flash->addMessage('danger', 'Nothing to edit.');
            return $response->withRedirect($this->c->router->pathFor($this->path));
        }
        return $this->c->view->render($response, $this->view, [
            'edit'     => $edit,
            'data'     => $edit->toArray(),
            'all_rows' => [],
        ]);
    }

    /**
     * Create handler.
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return mixed
     */
    public function create(Request $request, Response $response, $args)
    {
        if ($request->getParam($this->submit_name) === 'create') {
            $data = array_map('trim', $request->getParsedBody());
            $edit = new DataModel;
            if ($errors = $edit->validationErrors($data)) {
                // show the create page, preserving submitted form data
                return $this->c->view->render($response, $this->view, [
                    'validation_errors' => $errors,
                    'edit'              => $edit,
                    'data'              => $data,
                    'all_rows'          => [],
                ]);
            } else {
                $this->assignValues($edit, $data);
                $edit->save();
                $this->c->flash->addMessage('success', 'Created “'.htmlspecialchars($data[$this->name_field]).'”.');
            }
        }
        return $response->withRedirect($this->c->router->pathFor($this->path));
    }

    /**
     * Update/delete handler.
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return mixed
     */
    public function submit(Request $request, Response $response, $args)
    {
        $edit = DataModel::find($args['id']);
        if (!$edit) {
            $this->c->flash->addMessage('danger', 'Nothing to update.');
            return $response->withRedirect($this->c->router->pathFor($this->path));
        }
        $data = array_map('trim', $request->getParsedBody());
        if ($data[$this->submit_name] === 'delete') {
            $this->c->flash->addMessage('success', 'Deleted “'.htmlspecialchars($edit->email).'”.');
            $edit->delete();
        } elseif ($data[$this->submit_name] === 'update') {
            if ($errors = $this->validationErrors($data)) {
                // show the edit page, preserving submitted form data
                return $this->c->view->render($response, $this->view, [
                    'validation_errors' => $errors,
                    'edit'              => $edit,
                    'data'              => $data,
                    'all_rows'          => [],
                ]);
            } else {
                $this->assignValues($edit, $data);
                $edit->save();
                $this->c->flash->addMessage('success', 'Updated “'.htmlspecialchars($data[$this->name_field]).'”.');
            }
        }
        return $response->withRedirect($this->c->router->pathFor($this->path));
    }

    protected function assignValues(&$object, &$data)
    {
        $object->email      = $data['email'];
        $object->user_level = (int)$data['user_level'];
    }
}
