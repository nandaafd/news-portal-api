<?php

namespace App\Http\Controllers;

use App\Repositories\Comment\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function index()
    {
        $result = $this->commentRepository->getComment();
        return response()->json([
            'message'=>'berhasil ambil komentar',
            'data'=>$result
        ],200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (Gate::allows('user')) {
            $result = $this->commentRepository->createComment($data);
        }else{
            return response()->json([
                'message'=>'Anda tidak memiliki akses'
            ],403);
        }
        return response()->json([
            'message'=>'berhasil tambah comment',
            'data'=>$result
        ]);
    }

    public function show(string $id)
    {
        $result = $this->commentRepository->getCommentById($id);
        return response()->json([
            'message'=>'berhasil ambil comment',
            'data'=>$result,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $result = $this->commentRepository->updateComment($id, $data);
        return response()->json([
            'message'=>'berhasil edit comment',
            'data'=>$result
        ]);
    }

    public function destroy(string $id)
    {
        $this->commentRepository->deleteComment($id);
        return response()->json([
            'message'=>'berhasil delete comment',
        ]);
    }
}
