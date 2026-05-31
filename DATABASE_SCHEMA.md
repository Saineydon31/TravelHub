# TravelHub Database Schema

## 📊 Database Overview

Complete relational database design for TravelHub with 45+ tables supporting all business operations, user management, bookings, payments, affiliate marketing, and administrative functions.

---

## Entity Relationship Diagram (ASCII)

```
┌─────────────┐         ┌─────────────┐         ┌─────────────┐
│   Users     │────┬────│   Roles     │────┬────│ Permissions │
└─────────────┘    │    └─────────────┘    │    └─────────────┘
      │            │           │           │           │
      │       ┌────┴───────────┼───────────┴────┐      │
      │       │                │                │      │
      ├───────┼─┐         ┌────┴────┐      ┌────┴──────┴───┐
      │       │ │         │         │      │              │
   ┌──▼──┐ ┌──▼─▼──┐   ┌──▼──┐  ┌──▼──┐  │  ┌──────────┐│
   │Tasks│ │Vendors│   │Affiliate│ │ Bookings│  │ Payments ││
   └─────┘ └──┬────┘   └──────┘  └──┬───┘  │  └──────────┘│
             │                      │      │              │
        ┌────┴────┬────────────┬────┴──┐   │  ┌──────────────┐
        │          │            │       │   │  │ Commission   │
     ┌──▼───┐  ┌───▼─┐    ┌────▼───┐ ┌▼───▼──┤  │ Settlement   │
     │Tours │  │Hotels│    │ Reviews │ │Reviews│  └──────────────┘
     └──────┘  └──────┘    └────────┘ └───────┘
```

---

## Core Tables

### 1. users
Primary user table for all system users.

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    role_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    country_code VARCHAR(5),
    phone_verified_at TIMESTAMP NULL,
    avatar_url VARCHAR(500),
    bio TEXT,
    is_active BOOLEAN DEFAULT true,
    is_verified BOOLEAN DEFAULT false,
    two_factor_enabled BOOLEAN DEFAULT false,
    last_login_at TIMESTAMP NULL,
    remember_token VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (role_id) REFERENCES roles(id),
    INDEX idx_email (email),
    INDEX idx_role_id (role_id),
    INDEX idx_created_at (created_at)
);
```

### 2. roles
User roles (Traveler, Vendor, Admin, CEO, etc.).

```sql
CREATE TABLE roles (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    display_name VARCHAR(255),
    description TEXT,
    is_system BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    INDEX idx_name (name)
);
```

### 3. permissions
Fine-grained permissions for role-based access control.

```sql
CREATE TABLE permissions (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    display_name VARCHAR(255),
    description TEXT,
    module VARCHAR(100),
    action VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    INDEX idx_module (module),
    INDEX idx_name (name)
);
```

### 4. role_permission
Mapping between roles and permissions.

```sql
CREATE TABLE role_permission (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    role_id BIGINT UNSIGNED NOT NULL,
    permission_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP,
    
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    UNIQUE KEY unique_role_permission (role_id, permission_id)
);
```

---

## Vendor Tables

### 5. vendors
Vendor profiles and information.

```sql
CREATE TABLE vendors (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL UNIQUE,
    vendor_type_id BIGINT UNSIGNED NOT NULL,
    business_name VARCHAR(255) NOT NULL,
    business_email VARCHAR(255),
    business_phone VARCHAR(20),
    business_registration_number VARCHAR(100),
    tax_identification_number VARCHAR(100),
    country VARCHAR(100),
    state_province VARCHAR(100),
    city VARCHAR(100),
    postal_code VARCHAR(20),
    address TEXT,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    website_url VARCHAR(500),
    logo_url VARCHAR(500),
    banner_url VARCHAR(500),
    description TEXT,
    verification_status ENUM('pending', 'approved', 'rejected', 'suspended') DEFAULT 'pending',
    commission_rate DECIMAL(5, 2) DEFAULT 10.00,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vendor_type_id) REFERENCES vendor_types(id),
    INDEX idx_user_id (user_id),
    INDEX idx_vendor_type_id (vendor_type_id),
    INDEX idx_verification_status (verification_status),
    INDEX idx_country_city (country, city)
);
```

### 6. vendor_types
Types of vendors in the system.

```sql
CREATE TABLE vendor_types (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE,
    display_name VARCHAR(255),
    description TEXT,
    icon_url VARCHAR(500),
    module_name VARCHAR(100),
    requires_verification BOOLEAN DEFAULT true,
    commission_default DECIMAL(5, 2) DEFAULT 10.00,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    INDEX idx_name (name)
);
```

### 7. vendor_verifications
Vendor verification documents and status.

```sql
CREATE TABLE vendor_verifications (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    vendor_id BIGINT UNSIGNED NOT NULL,
    document_type VARCHAR(100),
    document_url VARCHAR(500),
    document_number VARCHAR(100),
    issue_date DATE,
    expiry_date DATE,
    verification_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    verified_by BIGINT UNSIGNED,
    verification_notes TEXT,
    verified_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    FOREIGN KEY (verified_by) REFERENCES users(id),
    INDEX idx_vendor_id (vendor_id),
    INDEX idx_verification_status (verification_status)
);
```

### 8. vendor_bank_accounts
Vendor bank account information for settlements.

```sql
CREATE TABLE vendor_bank_accounts (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    vendor_id BIGINT UNSIGNED NOT NULL,
    account_holder_name VARCHAR(255) NOT NULL,
    bank_name VARCHAR(255) NOT NULL,
    account_number VARCHAR(50) NOT NULL,
    account_type ENUM('savings', 'checking') DEFAULT 'checking',
    routing_number VARCHAR(50),
    swift_code VARCHAR(20),
    iban VARCHAR(50),
    country VARCHAR(100),
    is_primary BOOLEAN DEFAULT true,
    is_verified BOOLEAN DEFAULT false,
    verified_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    INDEX idx_vendor_id (vendor_id),
    UNIQUE KEY unique_primary_account (vendor_id, is_primary)
);
```

---

## Listing Tables

### 9. tours
Tour/experience listings.

```sql
CREATE TABLE tours (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    vendor_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    description LONGTEXT,
    short_description VARCHAR(500),
    category VARCHAR(100),
    subcategory VARCHAR(100),
    location VARCHAR(255),
    country VARCHAR(100),
    state_province VARCHAR(100),
    city VARCHAR(100),
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    duration_days INT,
    duration_nights INT,
    min_participants INT,
    max_participants INT,
    difficulty_level ENUM('easy', 'moderate', 'hard', 'expert') DEFAULT 'moderate',
    language VARCHAR(50),
    cover_image_url VARCHAR(500),
    is_published BOOLEAN DEFAULT false,
    is_featured BOOLEAN DEFAULT false,
    rating_average DECIMAL(3, 2) DEFAULT 0,
    total_reviews INT DEFAULT 0,
    total_bookings INT DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    INDEX idx_vendor_id (vendor_id),
    INDEX idx_slug (slug),
    INDEX idx_location (country, city),
    INDEX idx_is_published (is_published),
    FULLTEXT INDEX ft_title_description (title, description)
);
```

### 10. itineraries
Tour itinerary details.

```sql
CREATE TABLE itineraries (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    tour_id BIGINT UNSIGNED NOT NULL,
    day_number INT NOT NULL,
    title VARCHAR(255),
    description LONGTEXT,
    accommodation VARCHAR(255),
    meals VARCHAR(100),
    activities TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE,
    INDEX idx_tour_id (tour_id),
    UNIQUE KEY unique_tour_day (tour_id, day_number)
);
```

### 11. hotels
Hotel listings.

```sql
CREATE TABLE hotels (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    vendor_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    description LONGTEXT,
    star_rating INT DEFAULT 3,
    check_in_time TIME DEFAULT '14:00:00',
    check_out_time TIME DEFAULT '11:00:00',
    country VARCHAR(100),
    state_province VARCHAR(100),
    city VARCHAR(100),
    postal_code VARCHAR(20),
    address TEXT,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    phone VARCHAR(20),
    email VARCHAR(255),
    website VARCHAR(500),
    cover_image_url VARCHAR(500),
    rating_average DECIMAL(3, 2) DEFAULT 0,
    total_reviews INT DEFAULT 0,
    total_rooms INT DEFAULT 0,
    is_published BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    INDEX idx_vendor_id (vendor_id),
    INDEX idx_slug (slug),
    INDEX idx_location (country, city),
    FULLTEXT INDEX ft_name (name)
);
```

### 12. rooms
Hotel rooms.

```sql
CREATE TABLE rooms (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    hotel_id BIGINT UNSIGNED NOT NULL,
    room_number VARCHAR(50),
    room_type ENUM('single', 'double', 'twin', 'suite', 'villa') DEFAULT 'double',
    capacity INT DEFAULT 2,
    price_per_night DECIMAL(12, 2) NOT NULL,
    base_price DECIMAL(12, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    sqft INT,
    bed_type VARCHAR(100),
    bathroom_count INT DEFAULT 1,
    amenities JSON,
    images JSON,
    is_available BOOLEAN DEFAULT true,
    max_guests INT DEFAULT 2,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
    INDEX idx_hotel_id (hotel_id),
    INDEX idx_is_available (is_available)
);
```

### 13. room_availability
Room availability calendar.

```sql
CREATE TABLE room_availability (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    room_id BIGINT UNSIGNED NOT NULL,
    availability_date DATE NOT NULL,
    is_available BOOLEAN DEFAULT true,
    reserved_count INT DEFAULT 0,
    price_adjustment DECIMAL(12, 2) DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE,
    UNIQUE KEY unique_room_date (room_id, availability_date),
    INDEX idx_availability_date (availability_date)
);
```

### 14. restaurants
Restaurant listings.

```sql
CREATE TABLE restaurants (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    vendor_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    description LONGTEXT,
    cuisine_type VARCHAR(100),
    price_range ENUM('$', '$$', '$$$', '$$$$') DEFAULT '$$',
    opening_time TIME DEFAULT '09:00:00',
    closing_time TIME DEFAULT '22:00:00',
    country VARCHAR(100),
    city VARCHAR(100),
    address TEXT,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    phone VARCHAR(20),
    website VARCHAR(500),
    cover_image_url VARCHAR(500),
    rating_average DECIMAL(3, 2) DEFAULT 0,
    total_reviews INT DEFAULT 0,
    is_published BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    INDEX idx_vendor_id (vendor_id),
    INDEX idx_slug (slug),
    FULLTEXT INDEX ft_name (name)
);
```

---

## Booking Tables

### 15. bookings
Main booking records.

```sql
CREATE TABLE bookings (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    booking_number VARCHAR(50) UNIQUE NOT NULL,
    traveler_id BIGINT UNSIGNED NOT NULL,
    vendor_id BIGINT UNSIGNED NOT NULL,
    booking_date DATE NOT NULL,
    check_in_date DATE,
    check_out_date DATE,
    status ENUM('pending', 'confirmed', 'in_progress', 'completed', 'cancelled') DEFAULT 'pending',
    special_requests TEXT,
    guest_count INT DEFAULT 1,
    total_price DECIMAL(15, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    booking_source VARCHAR(100),
    cancellation_reason TEXT,
    cancelled_by VARCHAR(100),
    cancelled_at TIMESTAMP NULL,
    completed_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (traveler_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    INDEX idx_traveler_id (traveler_id),
    INDEX idx_vendor_id (vendor_id),
    INDEX idx_booking_number (booking_number),
    INDEX idx_status (status),
    INDEX idx_booking_date (booking_date),
    INDEX idx_check_in_date (check_in_date)
);
```

### 16. booking_items
Individual items in a booking.

```sql
CREATE TABLE booking_items (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    booking_id BIGINT UNSIGNED NOT NULL,
    booking_type ENUM('tour', 'hotel', 'restaurant', 'flight', 'transportation', 'vehicle', 'boat', 'equipment') NOT NULL,
    booking_item_id BIGINT UNSIGNED,
    item_name VARCHAR(255) NOT NULL,
    item_description TEXT,
    quantity INT DEFAULT 1,
    unit_price DECIMAL(12, 2) NOT NULL,
    subtotal DECIMAL(15, 2) NOT NULL,
    discount_amount DECIMAL(15, 2) DEFAULT 0,
    tax_amount DECIMAL(15, 2) DEFAULT 0,
    total_amount DECIMAL(15, 2) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    INDEX idx_booking_id (booking_id),
    INDEX idx_booking_type (booking_type)
);
```

---

## Payment Tables

### 17. payments
Payment transactions.

```sql
CREATE TABLE payments (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    payment_reference VARCHAR(100) UNIQUE NOT NULL,
    booking_id BIGINT UNSIGNED NOT NULL,
    traveler_id BIGINT UNSIGNED NOT NULL,
    vendor_id BIGINT UNSIGNED NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    payment_method ENUM('stripe', 'paypal', 'bank_transfer', 'mobile_money', 'cash') NOT NULL,
    payment_gateway_id VARCHAR(255),
    status ENUM('pending', 'processing', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    transaction_id VARCHAR(255),
    payer_details JSON,
    payee_details JSON,
    metadata JSON,
    processed_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (traveler_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    INDEX idx_payment_reference (payment_reference),
    INDEX idx_booking_id (booking_id),
    INDEX idx_status (status),
    INDEX idx_traveler_id (traveler_id),
    INDEX idx_vendor_id (vendor_id)
);
```

### 18. commissions
Platform commissions.

```sql
CREATE TABLE commissions (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    payment_id BIGINT UNSIGNED NOT NULL,
    vendor_id BIGINT UNSIGNED NOT NULL,
    commission_type ENUM('percentage', 'fixed', 'tiered') DEFAULT 'percentage',
    commission_rate DECIMAL(5, 2) NOT NULL,
    gross_amount DECIMAL(15, 2) NOT NULL,
    commission_amount DECIMAL(15, 2) NOT NULL,
    net_amount DECIMAL(15, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    status ENUM('pending', 'settled', 'pending_approval', 'rejected') DEFAULT 'pending',
    settled_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (payment_id) REFERENCES payments(id) ON DELETE CASCADE,
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    INDEX idx_vendor_id (vendor_id),
    INDEX idx_status (status)
);
```

### 19. refunds
Refund transactions.

```sql
CREATE TABLE refunds (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    refund_reference VARCHAR(100) UNIQUE NOT NULL,
    payment_id BIGINT UNSIGNED NOT NULL,
    booking_id BIGINT UNSIGNED NOT NULL,
    reason VARCHAR(255),
    amount DECIMAL(15, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    status ENUM('pending', 'approved', 'processing', 'completed', 'rejected') DEFAULT 'pending',
    approved_by BIGINT UNSIGNED,
    processed_by BIGINT UNSIGNED,
    approved_at TIMESTAMP NULL,
    processed_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (payment_id) REFERENCES payments(id) ON DELETE CASCADE,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (approved_by) REFERENCES users(id),
    FOREIGN KEY (processed_by) REFERENCES users(id),
    INDEX idx_refund_reference (refund_reference),
    INDEX idx_status (status)
);
```

### 20. vendor_payouts
Vendor settlement payouts.

```sql
CREATE TABLE vendor_payouts (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    payout_reference VARCHAR(100) UNIQUE NOT NULL,
    vendor_id BIGINT UNSIGNED NOT NULL,
    bank_account_id BIGINT UNSIGNED,
    payout_method ENUM('bank_transfer', 'check', 'paypal', 'mobile_money') DEFAULT 'bank_transfer',
    gross_amount DECIMAL(15, 2) NOT NULL,
    fees DECIMAL(15, 2) DEFAULT 0,
    net_amount DECIMAL(15, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    status ENUM('pending', 'pending_approval', 'approved', 'processing', 'completed', 'failed', 'reversed') DEFAULT 'pending',
    approved_by BIGINT UNSIGNED,
    processed_by BIGINT UNSIGNED,
    approved_at TIMESTAMP NULL,
    processed_at TIMESTAMP NULL,
    period_from DATE,
    period_to DATE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    FOREIGN KEY (bank_account_id) REFERENCES vendor_bank_accounts(id),
    FOREIGN KEY (approved_by) REFERENCES users(id),
    FOREIGN KEY (processed_by) REFERENCES users(id),
    INDEX idx_vendor_id (vendor_id),
    INDEX idx_status (status),
    INDEX idx_payout_reference (payout_reference)
);
```

---

## Affiliate Tables

### 21. affiliates
Affiliate account management.

```sql
CREATE TABLE affiliates (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL UNIQUE,
    affiliate_code VARCHAR(50) UNIQUE NOT NULL,
    commission_rate DECIMAL(5, 2) DEFAULT 5.00,
    commission_type ENUM('percentage', 'fixed') DEFAULT 'percentage',
    referral_limit INT,
    is_active BOOLEAN DEFAULT true,
    total_referrals INT DEFAULT 0,
    total_commissions DECIMAL(15, 2) DEFAULT 0,
    total_earned DECIMAL(15, 2) DEFAULT 0,
    bank_account_id BIGINT UNSIGNED,
    withdrawal_minimum DECIMAL(15, 2) DEFAULT 100.00,
    approved_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (bank_account_id) REFERENCES vendor_bank_accounts(id),
    INDEX idx_user_id (user_id),
    INDEX idx_affiliate_code (affiliate_code),
    INDEX idx_is_active (is_active)
);
```

### 22. affiliate_referrals
Referral tracking.

```sql
CREATE TABLE affiliate_referrals (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    affiliate_id BIGINT UNSIGNED NOT NULL,
    referred_user_id BIGINT UNSIGNED,
    referral_link VARCHAR(500),
    referral_source VARCHAR(100),
    referral_type ENUM('registration', 'booking', 'purchase') DEFAULT 'registration',
    conversion_status ENUM('pending', 'converted', 'abandoned') DEFAULT 'pending',
    converted_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (affiliate_id) REFERENCES affiliates(id) ON DELETE CASCADE,
    FOREIGN KEY (referred_user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_affiliate_id (affiliate_id),
    INDEX idx_conversion_status (conversion_status)
);
```

### 23. affiliate_commissions
Commission earnings tracking.

```sql
CREATE TABLE affiliate_commissions (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    affiliate_id BIGINT UNSIGNED NOT NULL,
    payment_id BIGINT UNSIGNED,
    booking_id BIGINT UNSIGNED,
    commission_amount DECIMAL(15, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    status ENUM('pending', 'approved', 'settled', 'reversed') DEFAULT 'pending',
    settled_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (affiliate_id) REFERENCES affiliates(id) ON DELETE CASCADE,
    FOREIGN KEY (payment_id) REFERENCES payments(id) ON DELETE SET NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE SET NULL,
    INDEX idx_affiliate_id (affiliate_id),
    INDEX idx_status (status)
);
```

---

## Review & Rating Tables

### 24. reviews
User reviews and ratings.

```sql
CREATE TABLE reviews (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    reviewer_id BIGINT UNSIGNED NOT NULL,
    booking_id BIGINT UNSIGNED NOT NULL,
    vendor_id BIGINT UNSIGNED NOT NULL,
    review_type ENUM('tour', 'hotel', 'restaurant', 'guide', 'transportation', 'vehicle', 'boat', 'equipment') NOT NULL,
    rating INT DEFAULT 5,
    title VARCHAR(255),
    comment LONGTEXT,
    verified_booking BOOLEAN DEFAULT true,
    is_approved BOOLEAN DEFAULT true,
    is_featured BOOLEAN DEFAULT false,
    helpful_count INT DEFAULT 0,
    unhelpful_count INT DEFAULT 0,
    vendor_response TEXT,
    vendor_response_date TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (reviewer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    INDEX idx_vendor_id (vendor_id),
    INDEX idx_rating (rating),
    INDEX idx_is_approved (is_approved),
    FULLTEXT INDEX ft_title_comment (title, comment)
);
```

---

## Messaging Tables

### 25. conversations
Chat conversations.

```sql
CREATE TABLE conversations (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    participant_1_id BIGINT UNSIGNED NOT NULL,
    participant_2_id BIGINT UNSIGNED NOT NULL,
    conversation_type ENUM('direct', 'support', 'vendor_support', 'admin') DEFAULT 'direct',
    last_message_at TIMESTAMP NULL,
    is_archived BOOLEAN DEFAULT false,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (participant_1_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (participant_2_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_participants (participant_1_id, participant_2_id),
    INDEX idx_last_message_at (last_message_at)
);
```

### 26. messages
Individual messages.

```sql
CREATE TABLE messages (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    conversation_id BIGINT UNSIGNED NOT NULL,
    sender_id BIGINT UNSIGNED NOT NULL,
    recipient_id BIGINT UNSIGNED NOT NULL,
    message_text LONGTEXT,
    message_type ENUM('text', 'image', 'file', 'voice', 'video') DEFAULT 'text',
    attachment_url VARCHAR(500),
    is_read BOOLEAN DEFAULT false,
    read_at TIMESTAMP NULL,
    edited_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (recipient_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_conversation_id (conversation_id),
    INDEX idx_sender_id (sender_id),
    INDEX idx_is_read (is_read),
    INDEX idx_created_at (created_at)
);
```

---

## Notification Tables

### 27. notifications
User notifications.

```sql
CREATE TABLE notifications (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    notification_type VARCHAR(100),
    title VARCHAR(255),
    message TEXT,
    action_url VARCHAR(500),
    related_resource_type VARCHAR(100),
    related_resource_id BIGINT UNSIGNED,
    is_read BOOLEAN DEFAULT false,
    read_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_is_read (is_read),
    INDEX idx_created_at (created_at)
);
```

---

## Support & Admin Tables

### 28. support_tickets
Customer support tickets.

```sql
CREATE TABLE support_tickets (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    ticket_number VARCHAR(50) UNIQUE NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    assigned_to BIGINT UNSIGNED,
    category VARCHAR(100),
    subject VARCHAR(255) NOT NULL,
    description LONGTEXT,
    priority ENUM('low', 'medium', 'high', 'critical') DEFAULT 'medium',
    status ENUM('open', 'in_progress', 'waiting_customer', 'resolved', 'closed') DEFAULT 'open',
    resolution_text TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    resolved_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_ticket_number (ticket_number),
    INDEX idx_status (status),
    INDEX idx_priority (priority),
    INDEX idx_assigned_to (assigned_to)
);
```

### 29. fraud_alerts
Fraud detection and alerts.

```sql
CREATE TABLE fraud_alerts (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    alert_type VARCHAR(100),
    user_id BIGINT UNSIGNED,
    booking_id BIGINT UNSIGNED,
    payment_id BIGINT UNSIGNED,
    fraud_score DECIMAL(5, 2),
    risk_level ENUM('low', 'medium', 'high', 'critical') DEFAULT 'medium',
    description TEXT,
    is_investigated BOOLEAN DEFAULT false,
    is_confirmed BOOLEAN DEFAULT false,
    investigated_by BIGINT UNSIGNED,
    action_taken VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE SET NULL,
    FOREIGN KEY (payment_id) REFERENCES payments(id) ON DELETE SET NULL,
    FOREIGN KEY (investigated_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_risk_level (risk_level),
    INDEX idx_is_investigated (is_investigated)
);
```

### 30. audit_logs
System audit logs for compliance.

```sql
CREATE TABLE audit_logs (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED,
    action VARCHAR(255),
    resource_type VARCHAR(100),
    resource_id BIGINT UNSIGNED,
    old_values JSON,
    new_values JSON,
    ip_address VARCHAR(45),
    user_agent TEXT,
    status ENUM('success', 'failure') DEFAULT 'success',
    error_message TEXT,
    created_at TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_resource_type (resource_type),
    INDEX idx_created_at (created_at),
    INDEX idx_action (action)
);
```

---

## Analytics & Settings Tables

### 31. analytics_reports
Pre-generated analytics reports.

```sql
CREATE TABLE analytics_reports (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    report_type VARCHAR(100),
    vendor_id BIGINT UNSIGNED,
    user_id BIGINT UNSIGNED,
    report_data JSON,
    period_from DATE,
    period_to DATE,
    generated_at TIMESTAMP,
    created_at TIMESTAMP,
    
    FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_report_type (report_type),
    INDEX idx_vendor_id (vendor_id),
    INDEX idx_generated_at (generated_at)
);
```

### 32. platform_settings
Platform configuration settings.

```sql
CREATE TABLE platform_settings (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(255) NOT NULL UNIQUE,
    setting_value LONGTEXT,
    setting_type VARCHAR(50),
    description TEXT,
    is_public BOOLEAN DEFAULT false,
    updated_by BIGINT UNSIGNED,
    updated_at TIMESTAMP,
    created_at TIMESTAMP,
    
    FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_setting_key (setting_key)
);
```

### 33. campaigns
Marketing campaigns.

```sql
CREATE TABLE campaigns (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    campaign_type ENUM('email', 'sms', 'push', 'social', 'banner') DEFAULT 'email',
    status ENUM('draft', 'active', 'paused', 'completed') DEFAULT 'draft',
    start_date TIMESTAMP,
    end_date TIMESTAMP,
    created_by BIGINT UNSIGNED,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_campaign_type (campaign_type)
);
```

### 34. coupons
Discount coupons.

```sql
CREATE TABLE coupons (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    coupon_code VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    discount_type ENUM('percentage', 'fixed_amount') DEFAULT 'percentage',
    discount_value DECIMAL(10, 2) NOT NULL,
    max_uses INT,
    current_uses INT DEFAULT 0,
    valid_from TIMESTAMP,
    valid_until TIMESTAMP,
    is_active BOOLEAN DEFAULT true,
    created_by BIGINT UNSIGNED,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_coupon_code (coupon_code),
    INDEX idx_is_active (is_active)
);
```

---

## Additional Supporting Tables

### 35. risk_assessments
Vendor and booking risk assessments.

```sql
CREATE TABLE risk_assessments (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    assessment_type ENUM('vendor', 'booking', 'payment', 'user') DEFAULT 'vendor',
    resource_id BIGINT UNSIGNED,
    risk_score DECIMAL(5, 2),
    risk_level ENUM('low', 'medium', 'high', 'critical') DEFAULT 'low',
    assessment_details JSON,
    assessed_by BIGINT UNSIGNED,
    assessed_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (assessed_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_resource_id (resource_id),
    INDEX idx_risk_level (risk_level),
    INDEX idx_assessed_at (assessed_at)
);
```

---

## Database Indexing Strategy

### Performance Indexes
- **Search Performance**: Full-text indexes on title, description, name fields
- **Foreign Key Indexes**: On all foreign key columns
- **Status Indexes**: On status, is_active, is_published fields
- **Date Indexes**: On created_at, updated_at, deleted_at fields
- **Location Indexes**: Composite indexes on country, city
- **User Indexes**: Composite indexes on user_id and status/type fields

### Query Optimization
- Indexes on WHERE clause columns
- Indexes on JOIN columns
- Indexes on ORDER BY columns
- Composite indexes for common query combinations

---

## Data Relationships

### Key Relationships
1. **Users → Roles** (Many-to-One)
2. **Roles ↔ Permissions** (Many-to-Many)
3. **Users → Vendors** (One-to-One)
4. **Vendors → Listings** (One-to-Many)
5. **Listings → Bookings** (One-to-Many)
6. **Bookings → Payments** (One-to-Many)
7. **Payments → Commissions** (One-to-Many)
8. **Users → Reviews** (One-to-Many)
9. **Users → Conversations** (Many-to-Many through Messages)
10. **Users → Affiliates** (One-to-One)

---

**Database Version**: 1.0
**Last Updated**: 2026-05-31
**Status**: Phase 2 - Complete
