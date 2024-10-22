import React, { useState } from 'react';
import axios from 'axios';
import './AddBook.css';

const AddBook = () => {
  const [book, setBook] = useState({
    title: '',
    author: '',
    year: '',
    genre: '',
    ISBN: '',
  });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setBook({ ...book, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:8000/books', book);
      console.log(response.data.message);
    } catch (error) {
      console.error('Error adding book:', error);
    }
  };

  return (
    <div class="container">
        <h2>Add a New Book</h2>
        <form id='addBookForm' onSubmit={handleSubmit}>
            <label for="title">Book Title</label>
            <input type="text" id="title" name="title" placeholder="Enter book title" value={book.title} onChange={handleInputChange} required />

            <label for="author">Author</label>
            <input type="text" id="author" name="author" placeholder="Enter author's name" value={book.author} onChange={handleInputChange} required />

            <label for="year">Publication Year</label>
            <input type="number" id="year" name="year" placeholder="Enter publication year" value={book.year} onChange={handleInputChange} required />

            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre" placeholder="Enter genre" value={book.genre} onChange={handleInputChange} required />

            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="ISBN" placeholder="Enter ISBN number" value={book.ISBN} onChange={handleInputChange} required />

            <input type="submit" value="Add Book" />
      </form>
    </div>
  );
};

export default AddBook;
