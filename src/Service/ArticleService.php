<?php


namespace App\Service;


use App\Model\ArticleModel;

class ArticleService implements ServiceInterface
{
    private ArticleModel $model;

    /**
     * ArticleService constructor.
     *
     * @param  ArticleModel  $model
     */
    public function __construct(ArticleModel $model)
    {
        $this->model = $model;
    }


    /**
     * @inheritDoc
     */
    public function index(): array
    {
        $page = $this->model->all();

        return $page;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function create(): mixed
    {

    }

    /**
     * @inheritDoc
     */
    public function store($properties)
    {
        return $this->model->insert($properties);
    }

    /**
     * @inheritDoc
     */
    public function show(int $id): array
    {
        return $this->model->find($id);
    }

    /**
     * @inheritDoc
     */
    public function edit(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function update()
    {
        $message = null;
        $filtered = GUMP::filter_input($_POST, $this->model->filter);
        $id = (int)$filtered['id'];
        //dd($filtered);
        unset($filtered['id']);
        $is_valid = GUMP::is_valid($filtered, $this->model->rules);
        if ($is_valid === true) {
            if ($this->model->update($id, $filtered) == null) {
                $message = 'Статья изменена';
            }
        } else {
            $message = $is_valid; // array of error messages
        }

        return $message;
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id): string
    {
        $message = 'error';
        $m = $this->model->destroy($id);

        if ($m == true) {
            $message = 'Статья удалена';
        }

        return $message;
    }

}