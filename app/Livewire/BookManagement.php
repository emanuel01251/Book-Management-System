<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class BookManagement extends Component
{
    use WithPagination;

    public $title;
    public $author;
    public $isbn;
    public $description;
    public $book_id;
    public $isEditing = false;

    protected $rules = [
        'title' => 'required|min:1',
        'author' => 'required|min:3',
        'isbn' => 'nullable|min_digits:10',
        'description' => 'nullable|string'
    ];

    public function render()
    {
        return view('livewire.book-management', [
            'books' => Book::paginate(5)
        ]);
    }

    public function store()
    {
        $this->validate([
            'isbn' => 'nullable|min_digits:10|unique:books,isbn',
        ]);

        Book::create([
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'description' => $this->description,
        ]);

        $this->resetInputs();
        session()->flash('message', 'Book created successfully.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $this->book_id = $id;
        $this->title = $book->title;
        $this->author = $book->author;
        $this->isbn = $book->isbn;
        $this->description = $book->description;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'isbn' => 'nullable|min_digits:10|unique:books,isbn,' . $this->book_id,
        ]);

        Book::find($this->book_id)->update([
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'description' => $this->description,
        ]);

        $this->resetInputs();
        session()->flash('message', 'Book updated successfully.');
    }

    public function delete($id)
    {
        Book::find($id)->delete();
        session()->flash('message', 'Book deleted successfully.');
    }

    private function resetInputs()
    {
        foreach(['title', 'author', 'isbn', 'description', 'book_id'] as $field) {
            $this->$field = '';
        }
        $this->isEditing = false;
    }
}
