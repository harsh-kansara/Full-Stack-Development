import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import FlightBookingForm from './FlightBookingForm';
import FlightBookingTable from './FlightBookingTable';

function App() {
  return (
    <Router>
      <div>
        <Routes>
          <Route path="/" element={<FlightBookingForm />} />
          <Route path="/bookings" element={<FlightBookingTable />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;

