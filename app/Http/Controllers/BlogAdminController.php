<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;
use App;
use App\Mail\MailNotifyBlog;
class BlogAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('Backoffice.blogs')->with('listBlogs', Blog::orderBy('created_at','DESC')->paginate(4));
    }
    public function indexFront()
    {
        return view ('Frontoffice.blog')->with('listBlogs', Blog::orderBy('created_at','DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backoffice.Blogs.addBlogAdmin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg,svg|max:5048',
        ]); 
        $newImageName= uniqid(). '-blog' . '.' . $request->image->extension();
        $request->image->move(public_path('images/blogs'), $newImageName);
        Blog::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'image'=>$newImageName,
            'user_id'=>auth()->user()->id
        ]);
        $data = [
            'subject' => 'New Blog !',
            'body' => substr($request->input('description'), 0, 150) ."...",
            'user_name' => $request->input('title'),
            'blog_image' => $newImageName
        ];
        $users=User::all();

        foreach ($users as $u) {
            Mail::to($u->email)->send(new MailNotifyBlog($data));
        }
        return redirect('/admin/blogs')->with('message','The blog added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $c=Comment::orderBy('created_at','DESC')->get()->where('blog_id',$id);
        $nbComments=Comment::orderBy('created_at','DESC')->get()->where('blog_id',$id)->count();
        $blog=Blog::where('id',$id)->first();
        return view('Backoffice.Blogs.showBlogAdmin', compact('blog','c', 'nbComments'));
    }
    public function showFront($id)
    {
        $b = Blog::where('id', $id)->first();
        $c=Comment::orderBy('created_at','DESC')->get()->where('blog_id',$id);
        $nbComments=Comment::orderBy('created_at','DESC')->get()->where('blog_id',$id)->count();
        $recentBlogs = Blog::orderBy('created_at', 'DESC')->take(3)->get();
        $shareButtons=\Share::page(
            url('/post'),
            'here is the text',
        )->facebook()->whatsapp()->telegram();
        return view('Frontoffice.singleblog', compact('b', 'recentBlogs','c', 'nbComments','shareButtons'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Backoffice.Blogs.editBlogAdmin')->with('blog', Blog::where('id',$id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
        ]); 
        if ($request->image){
            $newImageName= uniqid(). '-blog' . '.' . $request->image->extension();
            $request->image->move(public_path('images/blogs'), $newImageName);
            Blog::where('id',$id)->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'image'=>$newImageName,
                'user_id'=>auth()->user()->id
            ]);
        }else{
            Blog::where('id',$id)->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'user_id'=>auth()->user()->id
            ]);
        }
        
        return redirect('/admin/blogs')->with('message','The blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::where('id', $id)->delete();
        return redirect('/admin/blogs')->with('message','The blog deleted successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $output = "";
        $searchTerm = $request->input('search');
        $user= User::where('name', 'LIKE', '%' . $searchTerm . '%')->first();    
        $blogs = Blog::where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('created_at', 'LIKE', '%' . $searchTerm . '%')
            ->get();  
            if($blogs){
                foreach ($blogs as $blog) {
                    $output .= '<tr>';
                    $output .= '<td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $blog->title . '</strong></td>';
                    $output .= '<td>' . substr($blog->description, 0, 50) . '</td>';
                    $output .= '<td><img src="../images/blogs/' . $blog->image . '" alt="Avatar" style="width:80px; height:80px" /></td>';
                    $output .= '<td><span class="badge bg-label-primary me-1">' . $blog->user->name . '</span></td>';
                    $output .= '<td>' . (new \DateTime($blog->created_at))->format('d/m/Y') . '</td>';
                    $output .= '<td>' ;
                    $output .= '<div class="d-flex align-items-center">' ;
                    $output .= '<a class="btn text-primary" href="/admin/blogs/'.$blog->id.' data-bs-toggle="tooltip" data-bs-offset="0,2" data-bs-placement="bottom" data-bs-html="true"  title="<span>Show</span>"><i class="bx bxs-show"></i></a>' ;
                    $output .= '<a class="btn text-secondary" href="/admin/blogs/'.$blog->id.'/edit" data-bs-toggle="tooltip" data-bs-offset="0,2" data-bs-placement="bottom" data-bs-html="true"  title=" <span>Edit</span>" ><i class="bx bx-edit-alt"></i></a>';
                    $output .='<button class="btn text-danger" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-'.$blog->id .'" ><i class="bx bx-trash "></i></button>';
                    $output .= '</div>' ;
                    $output .= '</td>' ;
                    $output .= '</tr>';
                }
            }  else{
                $output .= '<tr>';
                $output .= '<td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>No data found .</strong></td>';
                $output .= '</tr>';
            }
                
        return response($output);
    }
    public function translate(Request $request){
        App::setLocale($request->lang);
        session()->put('locale',$request->lang);
        return redirect()->back();

    }
     
}
