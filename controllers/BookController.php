<?php
namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Collection;
use app\models\Publisher;
use app\models\Author;
use app\models\Category;


include_once '../vendor/parsecsv/php-parsecsv/parsecsv.lib.php';

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'search' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex($id = null, $slug = null, $letter = null)
    {
        $category = Category::findOne(['id' => $id, 'slug' => $slug]);
        if (!is_null($id) && !is_null($slug) && $category === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        $categories = Category::find()->orderBy('id')->all();
        $searchModel = new BookSearch();
        $params = array_merge(Yii::$app->request->queryParams, ['letter' => $letter]);
        $params = array_merge($params, ['category' => $id]);
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->isAuthorized();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    private function buildBookAttributesFromPost(&$success, &$errors) {
        $request = \Yii::$app->request;
        $post = $request->post();
        // get collection
        $collectionname = $post['Book']['collectionName'];
        $collection = Collection::findOne(['name' => $collectionname]);
        if (!is_object($collection)) {
            $collection = new Collection();
            $collection->name = $collectionname;
            try {
                $collection->save();
                $success[] = Yii::t('app', 'La collection ' . $collection->name . ' a été créée');
            } catch (Exception $e) {
                $errors [] = 'COLLECTION - Une erreur est survenue pour "' . $collection->name . '" : ' . $e->getMessage();
            }
        }

        // get publisher
        $publishername = $post['Book']['publisherName'];
        $publisher = Publisher::findOne(['name' => $publishername]);
        if (!is_object($publisher)) {
            $publisher = new Publisher();
            $publisher->name = $publishername;
            try {
                $publisher->save();
                $success[] = Yii::t('app', 'L\'éditeur ' . $publisher->name . ' a été créé');
            } catch (Exception $e) {
                $errors [] = 'EDITEUR - Une erreur est survenue pour "' . $publisher->name . '" : ' . $e->getMessage();
            }
        }

        // get author
        $authorname = $post['Book']['authorFullname'];
        $author = Author::findOne(['fullname' => $authorname]);
        if (!is_object($author)) {
            $author = new Author();
            $author->fullname = $authorname;
            try {
                $author->save();
                $success[] = Yii::t('app', 'L\'auteur ' . $author->fullname . ' a été créé');
            } catch (Exception $e) {
                $errors [] = 'AUTEUR - Une erreur est survenue pour "' . $author->fullname . '" : ' . $e->getMessage();
            }
        }
        
        return ['collection' => $collection, 'publisher' => $publisher, 'author' => $author];
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->isAuthorized();
        $model = new Book();
        $categories = Category::find()->orderBy('name')->all();
        $success = array();
        $errors = array();
        
        if ($model->load(Yii::$app->request->post())) {
            $attributes = $this->buildBookAttributesFromPost($success, $errors);            
            $model->collection_id = $attributes['collection']->id;
            $model->author_id = $attributes['author']->id;
            $model->publisher_id = $attributes['publisher']->id;
            if($model->save()) {
                $success[] = Yii::t('app', 'The book has been created');
                $errorsString = '';
                foreach ($errors as $value) {
                    $errorsString .= '<li>' . $value . '</li>';
                }
                $successString = '';
                foreach ($success as $value) {
                    $successString .= '<li>' . $value . '</li>';
                }

                if(!empty($errors)) \Yii::$app->getSession()->setFlash('danger', Yii::t('app', $errorsString));
                if(!empty($success)) \Yii::$app->getSession()->setFlash('success', Yii::t('app', $successString));
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = Category::find()->all();
        $success = array();
        $errors = array();

        if ($model->load(Yii::$app->request->post())) {
            $attributes = $this->buildBookAttributesFromPost($success, $errors);            
            $model->collection_id = $attributes['collection']->id;
            $model->author_id = $attributes['author']->id;
            $model->publisher_id = $attributes['publisher']->id;
            if($model->save()) {
                $success[] = Yii::t('app', 'The book has been updated');
                $errorsString = '';
                foreach ($errors as $value) {
                    $errorsString .= '<li>' . $value . '</li>';
                }
                $successString = '';
                foreach ($success as $value) {
                    $successString .= '<li>' . $value . '</li>';
                }

                if(!empty($errors)) \Yii::$app->getSession()->setFlash('danger', Yii::t('app', $errorsString));
                if(!empty($success)) \Yii::$app->getSession()->setFlash('success', Yii::t('app', $successString));
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionImport()
    {
        $this->isAuthorized();
        $values = Yii::$app->request->post();
        if (!empty($_POST)) { //FIXME manage error (headers) // Full lowercase ?// warning si livre ressemblant
            set_time_limit(0);
            ini_set('memory_limit','256M');
            $category_id = $values['category'];
            
            $csv = new \parseCSV($_FILES['csvfile']['tmp_name']);
            $errors = [];
            $success = [];
            
            foreach ($csv->data as $row) {
                if(empty($row['Titre'])) {
                    $errors[] = 'LIVRE - Le titre du livre est vide.';
                    continue;
                }
                
                $bookTitle = $row['Titre'];
                $book = new Book();
                $book->title = $bookTitle;
                $book->ISBN = isset($row['ISBN']) ? $row['ISBN'] : '';
                $book->year = isset($row['Annee']) ? $row['Annee'] : '';
                $book->category_id = $category_id;
                
                // get collection
                $collection = Collection::findOne(['name' => $row['Collection']]);
                if(!is_object($collection)) {
                    $collection = new Collection();
                    $collection->name = $row['Collection'];
                    try {
                        $collection->save();
                        $success[] = 'COLLECTION - "' . $collection->name . '" a été créée';
                    } catch (Exception $e) {
                        $errors[] = 'COLLECTION - Une erreur est survenue pour "' . $bookTitle . '" : ' . $e->getMessage();
                    }
                }
                
                // get publisher
                $publisher = Publisher::findOne(['name' => $row['Editeur']]);
                if(!is_object($publisher)) {
                    $publisher = new Publisher();
                    $publisher->name = $row['Editeur'];
                    try {
                        $publisher->save();
                        $success[] = 'EDITEUR - "' . $publisher->name . '" a été créé';
                    } catch (Exception $e) {
                        $errors[] = 'EDITEUR - Une erreur est survenue pour "' . $bookTitle . '" : ' . $e->getMessage();
                    }
                }
                
                // get author
                $author = Author::findOne(['fullname' => $row['Auteur']]);
                if(!is_object($author)) {
                    $author = new Author();
                    $author->fullname = $row['Auteur'];
                    try {
                        $author->save();
                        $success[] = 'Auteur - "' . $author->fullname . '" a été créé';
                    } catch (Exception $e) {
                        $errors[] = 'Auteur - Une erreur est survenue pour "' . $bookTitle . '" : ' . $e->getMessage();
                    }
                }
                
                // create book
                $book->collection_id = $collection->id;
                $book->author_id = $author->id;
                $book->publisher_id = $publisher->id;
            
                try {
                    if(!$book->save()) {
                        $validationErrors = $book->getErrors();
                        foreach ($validationErrors as $key => $value) {
                            $errors[] = 'LIVRE - "' . $bookTitle . '" a généré une erreur sur ' . $key . ' : ' . $value[0];
                        }
                    } else {
                        $success[] = 'LIVRE - "' . $bookTitle . '" a bien été importé';
                    }
                } catch (Exception $e) {
                    $errors[] = 'LIVRE - Une erreur est survenue pour "' . $bookTitle . '" : ' . $e->getMessage();
                }
            }
            
            $errorsString = '';
            foreach ($errors as $value) {
                $errorsString .= '<li>' . $value . '</li>';
            }
            $successString = '';
            foreach ($success as $value) {
                $successString .= '<li>' . $value . '</li>';
            }
            
            if(!empty($errors)) \Yii::$app->getSession()->setFlash('danger', Yii::t('app', $errorsString));
            if(!empty($success)) \Yii::$app->getSession()->setFlash('success', Yii::t('app', $successString));
        }

        return $this->render('import', []);
    }
    
    public function actionGetBookData() {
        die("COUCOU");
    }

    public function actionSearch()
    {
        $params = Yii::$app->request->post();
        $value = $params['query'];
        
        $query = Book::find();

        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);
        
        $query->joinWith('collections');
        $query->joinWith('categories');        
        $query->joinWith('publishers');        
        $query->joinWith('authors');

        $query->orFilterWhere(['like', 'title', $value])
            ->orFilterWhere(['like', 'publisher.name', $value])
            ->orFilterWhere(['like', 'author.fullname', $value])
            ->orFilterWhere(['like', 'collection.name', $value]);

        $query->orderBy('title');
        
        return $this->render('search', [
            'dataProvider' => $dataProvider
        ]);
        
    }
    
    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $this->isAuthorized();
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    private function isAuthorized()
    {
        if(!Yii::$app->user->isAdmin()) {
            throw new \yii\web\HttpException('401', 'You need to log in to access this page.');
        }
    }
}
