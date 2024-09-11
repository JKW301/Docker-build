<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TodoModel;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todoModel = new TodoModel();
        
        try {
            $todos = $todoModel->getTodos();
            return view('todos', ['title' => 'Todos', 'todos' => $todos]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $todoModel = new TodoModel();
        
        try {
            $todoModel->addTodo($request->description);
            return redirect()->route('todos.index')->with('success', 'Todo ajouté avec succès !');
        } catch (\Exception $e) {
            return redirect()->route('todos.index')->with('error', 'Une erreur est survenue lors de l\'ajout du todo.');
        }
    }
    
    public function destroy($id) {
        $todoModel = new TodoModel();
        try {
            $todoModel->deleteTodos($id);
            return redirect()->route('todos.index')->with('success', 'Todo supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('todos.index')->with('error', 'Une erreur s\'est produite lors de la suppression du todo.');
        }
    }
    
    public function update(Request $request, $id)
    {
        $todoModel = new TodoModel();

        try {
            $description = $request->input('description');
            $done = $request->input('done');

            $todoModel->updateTodo($id, $description, $done);

            return redirect()->route('todos.index')->with('success', 'Todo mis à jour avec succès');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
