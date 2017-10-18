<?php
namespace App\Controllers\Admin;

use App\Controllers\AbstractController;
use App\Models\User as DataModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserAdminController extends AbstractController
{
    private $path = 'admin-users';
    private $view = 'admin/users.twig';

    public function index($request, $response, $args)
    {
        return $this->c->view->render($response, $this->view, [
            'edit'     => null,
            'data'     => null,
            'all_rows' => DataModel::orderBy('email')->get(),
        ]);
    }

    public function edit(Request $request, Response $response, $args)
    {
        $edit = DataModel::find($args['id']);
        if (!$edit) {
            $this->c->flash->addMessage('danger', 'Nothing to edit.');
            return $response->withRedirect($this->c->router->pathFor($this->path));
        }
        return $this->c->view->render($response, $this->view, [
            'messages' => $this->c->flash->getMessages(),
            'edit'     => $edit,
            'data'     => $edit->toArray(),
            'all_rows' => [],
        ]);
    }

    public function create(Request $request, Response $response, $args)
    {
        $data = array_map('trim', $request->getParsedBody());
        if ($errors = $this->validate($data)) {
            // go back to create page, preserving submitted form data
            return $this->c->view->render($response, $this->view, [
                'messages' => $errors,
                'edit'     => null,
                'data'     => $data,
                'all_rows' => DataModel::get(),
            ]);
        } else {
            $row = new DataModel;
            $row->email = $data['email'];
            $row->full_name = $data['full_name'];
            $row->save();
            $this->c->flash->addMessage('success', 'Ua hoʻokomo ʻia ʻo “'.htmlspecialchars($data['full_name']).'”.');
        }
        return $response->withRedirect($this->c->router->pathFor($this->path));
    }

    public function submit(Request $request, Response $response, $args)
    {
        $edit = DataModel::find($args['id']);
        if (!$edit) {
            $this->c->flash->addMessage('danger', 'ʻAʻohe mea i hiki ke hoʻololi.');
            return $response->withRedirect($this->c->router->pathFor($this->path));
        }
        $data = array_map('trim', $request->getParsedBody());
        if ($data['submit'] === 'delete') {
            $this->c->flash->addMessage('success', 'Ua kīloi ʻia ʻo “'.htmlspecialchars($edit->full_name).'”.');
            $edit->delete();
        } elseif ($errors = $this->validate($data)) {
            // go back to edit page, preserving submitted form data
            return $this->c->view->render($response, $this->view, [
                'messages' => $errors,
                'edit' => $edit,
                'data' => $data,
                'all_rows' => [],
            ]);
        } else {
            $edit->email = $data['email'];
            $edit->full_name = $data['full_name'];
            $edit->save();
            $this->c->flash->addMessage('success', 'Ua mālama ʻia ʻo “'.htmlspecialchars($data['full_name']).'”.');
        }
        return $response->withRedirect($this->c->router->pathFor($this->path));
    }
}
