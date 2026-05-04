-- Drop tables in order (bookings depends on users and places)
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS messages;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS places;

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  phone VARCHAR(20) DEFAULT '',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE places (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  description TEXT,
  location VARCHAR(150) NOT NULL,
  photo VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE bookings (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  place_id INT UNSIGNED NOT NULL,
  place_name VARCHAR(150) NOT NULL,
  place_location VARCHAR(150) NOT NULL,
  service_type VARCHAR(50) NOT NULL,
  service_name VARCHAR(100) NOT NULL,
  price DECIMAL(8,2) NOT NULL,
  time_slot VARCHAR(20) NOT NULL,
  booking_date DATE NOT NULL,
  payment_method ENUM('place','website') NOT NULL DEFAULT 'place',
  payment_status VARCHAR(50) NOT NULL DEFAULT 'pay at place',
  status VARCHAR(50) NOT NULL DEFAULT 'confirmed',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users (id),
  FOREIGN KEY (place_id) REFERENCES places (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE messages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed: demo user
INSERT INTO users (id, full_name, email, password, phone) VALUES
(1, 'Demo Customer', 'demo@sparklewash.com', 'demo', '');

-- Seed: places
INSERT INTO places (id, name, description, location, photo) VALUES
(1, 'Sparkle Wash Center',  'Fast exterior and interior cleaning with careful finishing.',             'Nasr City, Cairo',  'https://images.unsplash.com/photo-1607860108855-64acf2078ed9?auto=format&fit=crop&w=900&q=80'),
(2, 'Premium Auto Spa',     'Comfortable waiting area, premium products, and full service packages.', 'New Cairo, Cairo',  'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=900&q=80'),
(3, 'Quick Shine Station',  'Reliable daily car wash service with flexible evening appointments.',    'Maadi, Cairo',      'https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?auto=format&fit=crop&w=900&q=80');
