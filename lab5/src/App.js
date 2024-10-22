// App.js
import React from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import './App.css'; // Import for the gradient background
import Calculator from './Calculator';
import Form from './Form';
import ResumeBuilder from './ResumeBuilder';
import ResumePreview from './ResumePreview';

function App() {
  return (
    <Router>
      <div className="app-container">
        <Routes>
          <Route path="/calculator" element={<Calculator />} />
          <Route path="/form" element={<Form />} />
          <Route path="/resume-builder" element={<ResumeBuilder />} />
          <Route path="/resume" element={<ResumePreview />} />
          <Route path="/" element={<Calculator />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
