<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Filters\ArticleFilter;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Status;
use App\User;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ArticleController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['permission:edit articles']);
    }

    /**
     * @param UserRepositoryInterface $userRepository
     * @return View
     */
    public function index(
        UserRepositoryInterface $userRepository
    ): View {
        $articles = Article::withTrashed()->latest()->with('category', 'user', 'status')->paginate(25);
        $editors = $userRepository->findByRoleName('Editor');
//        $editors = $userRepository->findByPermission('edit articles');

        return view('articles.index', [
            'articles' => $articles,
            'categories' => Category::all(),
            'statuses' => Status::all(),
            'editors' => $editors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * @param Article $article
     * @return void
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $article->setStatus('deleted');
        $article->delete();
    }

    public function publish(Article $article)
    {
        $article->setStatus('published');
    }

    /**
     * @param int $id
     */
    public function republish(int $id)
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->setStatus('published');
        $article->restore();
    }

    public function filter(ArticleFilter $filters)
    {
        $articles = $this->getArticles($filters);

        return view('articles.articles', ['articles' => $articles]);
    }

    public function getArticles(ArticleFilter $filters)
    {
        $articles = Article::filter($filters);

        return $articles->withTrashed()->latest()->with('category', 'user', 'status')->paginate(25);
    }

    public function generate(int $count, Generator $faker)
    {
        if (config('app.debug') === true && !count(Article::all())) {
            $categories = Category::all();
            $statuses = Status::all();
            for ($i = 0; $i < $count; $i++) {
                $cr = rand(0, count($categories) - 1);
                $sr = rand(0, count($statuses) - 1);
                $article = Article::create([
                    'title' => $faker->sentence,
                    'body'  => $faker->paragraph,
                    'user_twitch_id' => auth()->user()->twitch_id
                ]);

                $article->category()->associate($categories[$cr]);
                $article->status()->associate($statuses[$sr]);

                $article->save();
            }

            echo "{$count} articles generated";
        } else {
            echo 'Not in debug mode, or articles were already generated';
        }
    }
}
