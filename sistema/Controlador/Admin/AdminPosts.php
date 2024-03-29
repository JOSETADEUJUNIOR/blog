<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\PostModelo;
use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Helpers;

/**
 * Classe AdminPosts
 *
 * @author Jose Tadeu
 */
class AdminPosts extends AdminControlador
{
    public function listar(): void
    {
        $post = new PostModelo();
        echo $this->template->renderizar('posts/listar.html', [
            'posts' => $post->busca()->ordem('status ASC, id DESC')->resultado(true),
            'total'=> [
                'posts' => $post->total(),
                'postsAtivo' => $post->total('status = 1'),
                'postsInativo' => $post->total('status = 0') 
            ]
        ]);
    }

    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            $post = new PostModelo();
            $post->titulo = $dados['titulo'];
            $post->categoria_id = $dados['categoria_id'];
            $post->texto = $dados['texto'];
            $post->status = $dados['status'];

            if ($post->salvar()) {
                $this->mensagem->sucesso('Post cadastrado com sucesso')->flash();
                Helpers::redirecionar('admin/posts/listar');
            }
        }
        echo $this->template->renderizar('posts/formulario.html', [
            'categorias' => (new CategoriaModelo())->busca(),
        ]);
    }

    public function editar(int $id): void
    {
        $post = (new PostModelo())->buscaPorId($id);
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {

            $post = (new PostModelo())->buscaPorId($id);
            $post->titulo = $dados['titulo'];
            $post->categoria_id = $dados['categoria_id'];
            $post->texto = $dados['texto'];
            $post->status = $dados['status'];

            if ($post->salvar()) {
                $this->mensagem->sucesso('Post atualizado com sucesso')->flash();
                Helpers::redirecionar('admin/posts/listar');
            }

        }
        echo $this->template->renderizar('posts/formulario.html', [
            'post' => $post,
            'categorias' => (new CategoriaModelo())->busca(),
        ]);
    }

    public function deletar(int $id): void
    {
        (new PostModelo())->deletar($id);
            Helpers::redirecionar('admin/posts/listar');
    }
}
