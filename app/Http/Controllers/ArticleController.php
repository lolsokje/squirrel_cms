<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Filters\ArticleFilter;
use App\Http\Requests\ArticleRequest;
use App\Status;
use App\User;
use Faker\Generator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['permission:edit articles']);
    }

    /**
     * @return View
     */
    public function index(): View {
        $articles = Article::withTrashed()->latest()->with('category', 'user', 'status')->paginate(25);
        $editors = User::permission('edit articles')->get();

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
     * @return View
     */
    public function create(): View
    {
        return view('articles.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleRequest $request): RedirectResponse
    {
        $article = Article::create([
            'title' => $request->get('title'),
            'body'  => $request->get('body'),
            'category_id' => $request->get('category'),
            'user_twitch_id' => Auth::user()->twitch_id,
            'slug' => $request->get('slug')
        ]);

        /** @var Article $article */
        if ($request->get('save_action') === 'publish') {
            $article->setStatus('published');
        } else {
            $article->setStatus('draft');
        }

        return redirect()->route('articles.index');
    }

    /**
     * @param Article $article
     * @return View
     */
    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return View
     */
    public function edit(string $slug)
    {
        $article = Article::withTrashed()->where('slug', $slug)->first();
        return view('articles.edit', [
            'categories' => Category::all(),
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(ArticleRequest $request, string $slug)
    {
        $article = Article::withTrashed()->where('slug', $slug)->first();

        $saveAction = $request->get('save_action');

        if ($saveAction === 'perm_delete') {
            $article->forceDelete();
            return redirect()->route('articles.index');
        }

        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->category_id = $request->get('category');

        /** @var Article $article */
        if ($request->get('save_action') === 'publish') {
            $article->setStatus('published');
        } else {
            $article->setStatus('draft');
        }

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->setStatus('deleted');
        $article->delete();
        return $article->withTrashed()->with('category', 'user', 'status')->findOrFail($article->id);
    }

    public function publish(Article $article)
    {
        $article->setStatus('published');
        return $article->with('category', 'user', 'status')->findOrFail($article->id);
    }

    public function republish(string $slug)
    {
        $article = Article::withTrashed()->where('slug', $slug)->first();
        $article->setStatus('published');
        $article->restore();
        return $article->with('category', 'user', 'status')->where('slug', $slug)->first();
    }

    public function filter(ArticleFilter $filters)
    {
        return $this->getArticles($filters);
    }

    public function getArticles(ArticleFilter $filters)
    {
        $articles = Article::filter($filters);

        return $articles->withTrashed()->latest()->with('category', 'user', 'status')->get();
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
