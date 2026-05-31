# TravelHub API Documentation

## 🔌 API Overview

Complete REST API reference for TravelHub platform. All endpoints use JSON for request/response bodies and require authentication tokens (except public endpoints).

### Base URL
```
Development: http://localhost:8000/api/v1
Production: https://api.travelhub.com/v1
```

### Authentication
All protected endpoints require Bearer token in Authorization header:
```
Authorization: Bearer {access_token}
```

---

## Authentication Endpoints

### Register User
Register a new user on the platform.

**Endpoint:** `POST /auth/register`

**Request:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "SecurePassword123!",
  "password_confirmation": "SecurePassword123!",
  "phone": "+1234567890",
  "role": "traveler"
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "traveler",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "Bearer"
  }
}
```

### Login
Authenticate and receive access token.

**Endpoint:** `POST /auth/login`

**Request:**
```json
{
  "email": "john@example.com",
  "password": "SecurePassword123!"
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "traveler",
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "Bearer",
    "expires_in": 86400
  }
}
```

### Logout
Revoke access token.

**Endpoint:** `POST /auth/logout`

**Headers:**
```
Authorization: Bearer {access_token}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

### Refresh Token
Get a new access token.

**Endpoint:** `POST /auth/refresh`

**Headers:**
```
Authorization: Bearer {access_token}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "Bearer",
    "expires_in": 86400
  }
}
```

### Forgot Password
Request password reset link.

**Endpoint:** `POST /auth/forgot-password`

**Request:**
```json
{
  "email": "john@example.com"
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Password reset link sent to your email"
}
```

### Reset Password
Reset password with token.

**Endpoint:** `POST /auth/reset-password`

**Request:**
```json
{
  "email": "john@example.com",
  "token": "reset_token_from_email",
  "password": "NewPassword123!",
  "password_confirmation": "NewPassword123!"
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Password reset successfully"
}
```

---

## User Management Endpoints

### Get Current User
Get authenticated user profile.

**Endpoint:** `GET /users/me`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "avatar_url": "https://...",
    "bio": "Travel enthusiast",
    "role": "traveler",
    "is_verified": true,
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Update User Profile
Update user information.

**Endpoint:** `PUT /users/me`

**Request:**
```json
{
  "name": "John Updated",
  "phone": "+1987654321",
  "bio": "Adventure seeker"
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Profile updated successfully",
  "data": {
    "id": 1,
    "name": "John Updated",
    "phone": "+1987654321",
    "bio": "Adventure seeker"
  }
}
```

### Upload Avatar
Upload user profile picture.

**Endpoint:** `POST /users/me/avatar`

**Request:** (Form Data)
```
file: <binary_image_file>
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Avatar uploaded successfully",
  "data": {
    "avatar_url": "https://cdn.travelhub.com/avatars/user_1.jpg"
  }
}
```

### Change Password
Change user password.

**Endpoint:** `POST /users/me/change-password`

**Request:**
```json
{
  "current_password": "CurrentPassword123!",
  "new_password": "NewPassword123!",
  "password_confirmation": "NewPassword123!"
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Password changed successfully"
}
```

---

## Vendor Management Endpoints

### Register as Vendor
Convert user account to vendor.

**Endpoint:** `POST /vendors/register`

**Request:**
```json
{
  "vendor_type_id": 1,
  "business_name": "Adventure Tours Co.",
  "business_email": "business@example.com",
  "business_phone": "+1234567890",
  "tax_id": "TAX123456",
  "country": "United States",
  "state": "California",
  "city": "San Francisco",
  "address": "123 Travel St",
  "postal_code": "94103",
  "website": "https://example.com",
  "description": "Premium tour operator"
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "Vendor registered successfully",
  "data": {
    "id": 1,
    "user_id": 1,
    "business_name": "Adventure Tours Co.",
    "verification_status": "pending",
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Get Vendor Details
Get vendor profile information.

**Endpoint:** `GET /vendors/{vendor_id}`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "business_name": "Adventure Tours Co.",
    "business_email": "business@example.com",
    "country": "United States",
    "city": "San Francisco",
    "avatar_url": "https://...",
    "rating_average": 4.8,
    "total_reviews": 250,
    "verification_status": "approved",
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Update Vendor Profile
Update vendor business information.

**Endpoint:** `PUT /vendors/{vendor_id}`

**Request:**
```json
{
  "business_name": "Premium Adventure Tours",
  "description": "Updated description",
  "website": "https://newebsite.com"
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Vendor profile updated successfully"
}
```

### Get Vendor Listings
Get all listings for a vendor.

**Endpoint:** `GET /vendors/{vendor_id}/listings`

**Query Parameters:**
```
?page=1&per_page=10&sort=created_at&order=desc
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Mountain Hiking Tour",
      "slug": "mountain-hiking-tour",
      "type": "tour",
      "rating": 4.8,
      "total_reviews": 120,
      "price": 299.99,
      "currency": "USD",
      "image_url": "https://..."
    }
  ],
  "pagination": {
    "total": 45,
    "page": 1,
    "per_page": 10,
    "pages": 5
  }
}
```

### Get Vendor Dashboard
Get vendor dashboard data.

**Endpoint:** `GET /vendors/me/dashboard`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "total_listings": 12,
    "total_bookings": 250,
    "total_revenue": 50000.00,
    "this_month_bookings": 25,
    "this_month_revenue": 5000.00,
    "average_rating": 4.8,
    "pending_reviews": 5,
    "total_customers": 180
  }
}
```

---

## Listing Management Endpoints

### Create Listing
Create a new tour/service listing.

**Endpoint:** `POST /listings`

**Request:**
```json
{
  "vendor_id": 1,
  "listing_type": "tour",
  "title": "3-Day Mountain Trek",
  "description": "Experience the best mountain hiking",
  "category": "Adventure",
  "location": "Rocky Mountains",
  "country": "United States",
  "city": "Denver",
  "latitude": 39.7392,
  "longitude": -104.9903,
  "duration_days": 3,
  "max_participants": 10,
  "difficulty_level": "moderate",
  "base_price": 599.99,
  "currency": "USD",
  "images": ["url1", "url2", "url3"]
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "Listing created successfully",
  "data": {
    "id": 1,
    "title": "3-Day Mountain Trek",
    "slug": "3-day-mountain-trek",
    "status": "draft",
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Get Listing Details
Get complete listing information.

**Endpoint:** `GET /listings/{listing_id}`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "id": 1,
    "vendor": {
      "id": 1,
      "business_name": "Adventure Tours Co.",
      "rating": 4.8,
      "total_reviews": 250
    },
    "title": "3-Day Mountain Trek",
    "description": "Experience the best mountain hiking",
    "price": 599.99,
    "currency": "USD",
    "rating": 4.9,
    "total_reviews": 45,
    "images": ["url1", "url2", "url3"],
    "location": "Rocky Mountains",
    "duration_days": 3,
    "max_participants": 10,
    "current_bookings": 8,
    "availability_status": "available",
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Search Listings
Search and filter listings.

**Endpoint:** `GET /listings`

**Query Parameters:**
```
?q=mountain&category=adventure&country=USA&city=Denver
&min_price=100&max_price=1000
&rating=4&difficulty=moderate
&sort=rating&order=desc&page=1&per_page=20
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "3-Day Mountain Trek",
      "price": 599.99,
      "rating": 4.9,
      "image_url": "https://...",
      "location": "Rocky Mountains"
    }
  ],
  "pagination": {
    "total": 250,
    "page": 1,
    "per_page": 20,
    "pages": 13
  }
}
```

### Update Listing
Update listing details.

**Endpoint:** `PUT /listings/{listing_id}`

**Request:**
```json
{
  "title": "Updated Title",
  "description": "Updated description",
  "base_price": 649.99,
  "max_participants": 15
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Listing updated successfully"
}
```

### Publish Listing
Publish draft listing.

**Endpoint:** `POST /listings/{listing_id}/publish`

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Listing published successfully"
}
```

### Delete Listing
Delete a listing.

**Endpoint:** `DELETE /listings/{listing_id}`

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Listing deleted successfully"
}
```

---

## Booking Endpoints

### Create Booking
Create a new booking.

**Endpoint:** `POST /bookings`

**Request:**
```json
{
  "listing_id": 1,
  "vendor_id": 1,
  "check_in_date": "2026-06-15",
  "check_out_date": "2026-06-18",
  "guest_count": 2,
  "special_requests": "Window seat preferred",
  "total_price": 1199.98,
  "currency": "USD"
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "Booking created successfully",
  "data": {
    "id": 1,
    "booking_number": "BK20260531001",
    "status": "pending",
    "total_price": 1199.98,
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Get Booking Details
Get booking information.

**Endpoint:** `GET /bookings/{booking_id}`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "id": 1,
    "booking_number": "BK20260531001",
    "listing": {
      "id": 1,
      "title": "3-Day Mountain Trek",
      "vendor": {
        "id": 1,
        "business_name": "Adventure Tours Co."
      }
    },
    "check_in_date": "2026-06-15",
    "check_out_date": "2026-06-18",
    "guest_count": 2,
    "status": "confirmed",
    "total_price": 1199.98,
    "currency": "USD",
    "special_requests": "Window seat preferred",
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Get My Bookings
Get all bookings for current user.

**Endpoint:** `GET /bookings`

**Query Parameters:**
```
?status=all&sort=created_at&order=desc&page=1&per_page=10
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "booking_number": "BK20260531001",
      "title": "3-Day Mountain Trek",
      "status": "confirmed",
      "check_in_date": "2026-06-15",
      "total_price": 1199.98
    }
  ],
  "pagination": {
    "total": 15,
    "page": 1,
    "per_page": 10,
    "pages": 2
  }
}
```

### Cancel Booking
Cancel an existing booking.

**Endpoint:** `POST /bookings/{booking_id}/cancel`

**Request:**
```json
{
  "reason": "Change of plans"
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Booking cancelled successfully",
  "data": {
    "id": 1,
    "status": "cancelled",
    "refund_amount": 1199.98
  }
}
```

### Accept Booking (Vendor)
Accept a pending booking request.

**Endpoint:** `POST /bookings/{booking_id}/accept`

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Booking accepted successfully",
  "data": {
    "id": 1,
    "status": "confirmed"
  }
}
```

### Reject Booking (Vendor)
Reject a pending booking request.

**Endpoint:** `POST /bookings/{booking_id}/reject`

**Request:**
```json
{
  "reason": "Unavailable on those dates"
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Booking rejected successfully"
}
```

---

## Payment Endpoints

### Process Payment
Process payment for a booking.

**Endpoint:** `POST /payments`

**Request:**
```json
{
  "booking_id": 1,
  "amount": 1199.98,
  "currency": "USD",
  "payment_method": "stripe",
  "token": "pm_stripe_token_here",
  "save_payment_method": true
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "Payment processed successfully",
  "data": {
    "id": 1,
    "payment_reference": "PAY20260531001",
    "amount": 1199.98,
    "status": "completed",
    "transaction_id": "txn_stripe_123456",
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Get Payment Details
Get payment information.

**Endpoint:** `GET /payments/{payment_id}`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "id": 1,
    "payment_reference": "PAY20260531001",
    "booking_id": 1,
    "amount": 1199.98,
    "status": "completed",
    "payment_method": "stripe",
    "transaction_id": "txn_stripe_123456",
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Request Refund
Request refund for a payment.

**Endpoint:** `POST /payments/{payment_id}/refund`

**Request:**
```json
{
  "reason": "User requested cancellation",
  "amount": 1199.98
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "Refund requested successfully",
  "data": {
    "id": 1,
    "refund_reference": "REF20260531001",
    "amount": 1199.98,
    "status": "pending",
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Get Payment Methods
Get saved payment methods.

**Endpoint:** `GET /payments/methods`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "type": "card",
      "brand": "visa",
      "last_four": "4242",
      "expiry_month": 12,
      "expiry_year": 2026,
      "is_default": true
    }
  ]
}
```

---

## Review Endpoints

### Submit Review
Submit a review for a booking.

**Endpoint:** `POST /reviews`

**Request:**
```json
{
  "booking_id": 1,
  "vendor_id": 1,
  "rating": 5,
  "title": "Excellent experience!",
  "comment": "The tour was amazing and the guide was very knowledgeable."
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "Review submitted successfully",
  "data": {
    "id": 1,
    "rating": 5,
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Get Reviews
Get reviews for a listing/vendor.

**Endpoint:** `GET /reviews`

**Query Parameters:**
```
?vendor_id=1&sort=created_at&order=desc&page=1&per_page=10
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "reviewer": {
        "name": "John Doe",
        "avatar_url": "https://..."
      },
      "rating": 5,
      "title": "Excellent experience!",
      "comment": "The tour was amazing and the guide was very knowledgeable.",
      "verified_booking": true,
      "created_at": "2026-05-31T12:00:00Z"
    }
  ],
  "pagination": {
    "total": 250,
    "page": 1,
    "per_page": 10,
    "pages": 25
  }
}
```

### Respond to Review
Vendor responds to a review.

**Endpoint:** `POST /reviews/{review_id}/respond`

**Request:**
```json
{
  "response": "Thank you for your kind words! We look forward to seeing you again."
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Response added successfully"
}
```

---

## Messaging Endpoints

### Send Message
Send a message to another user.

**Endpoint:** `POST /messages`

**Request:**
```json
{
  "recipient_id": 2,
  "message_text": "Hi, I have a question about your tour.",
  "message_type": "text"
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "Message sent successfully",
  "data": {
    "id": 1,
    "conversation_id": 1,
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Get Conversations
Get user's chat conversations.

**Endpoint:** `GET /messages/conversations`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "participant": {
        "id": 2,
        "name": "Adventure Tours Co.",
        "avatar_url": "https://..."
      },
      "last_message": "We'll get back to you soon",
      "last_message_time": "2026-05-31T12:00:00Z",
      "unread_count": 2
    }
  ]
}
```

### Get Conversation Messages
Get messages in a conversation.

**Endpoint:** `GET /messages/conversations/{conversation_id}`

**Query Parameters:**
```
?page=1&per_page=20
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "sender_id": 1,
      "message_text": "Hi, I have a question",
      "message_type": "text",
      "is_read": true,
      "created_at": "2026-05-31T12:00:00Z"
    }
  ]
}
```

### Mark Message as Read
Mark message as read.

**Endpoint:** `PUT /messages/{message_id}/read`

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Message marked as read"
}
```

---

## Affiliate Endpoints

### Register as Affiliate
Register user as an affiliate.

**Endpoint:** `POST /affiliates/register`

**Request:**
```json
{
  "commission_rate": 10.00,
  "bank_account_id": 1
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "Affiliate registered successfully",
  "data": {
    "id": 1,
    "affiliate_code": "AFF123456",
    "commission_rate": 10.00,
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

### Get Affiliate Dashboard
Get affiliate dashboard data.

**Endpoint:** `GET /affiliates/me/dashboard`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "affiliate_code": "AFF123456",
    "total_referrals": 25,
    "converted_referrals": 18,
    "total_commissions": 450.00,
    "this_month_referrals": 5,
    "this_month_commissions": 75.00,
    "pending_payout": 450.00,
    "payout_threshold": 100.00
  }
}
```

### Get Referral Link
Generate referral link.

**Endpoint:** `GET /affiliates/me/referral-link`

**Query Parameters:**
```
?source=email&campaign=summer2026
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "referral_link": "https://travelhub.com?ref=AFF123456&source=email&campaign=summer2026",
    "short_link": "https://th.ref/AFF123456",
    "qr_code_url": "https://..."
  }
}
```

### Get Commissions
Get affiliate commission history.

**Endpoint:** `GET /affiliates/me/commissions`

**Query Parameters:**
```
?status=settled&sort=created_at&order=desc&page=1&per_page=20
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "referral": {
        "referred_user": "Jane Smith",
        "booking_title": "3-Day Mountain Trek"
      },
      "commission_amount": 50.00,
      "status": "settled",
      "settled_at": "2026-05-31T12:00:00Z"
    }
  ],
  "pagination": {
    "total": 25,
    "page": 1,
    "per_page": 20,
    "pages": 2
  }
}
```

### Request Payout
Request affiliate payout.

**Endpoint:** `POST /affiliates/me/payout-request`

**Request:**
```json
{
  "amount": 450.00,
  "payout_method": "bank_transfer"
}
```

**Response:** `201 Created`
```json
{
  "success": true,
  "message": "Payout request submitted",
  "data": {
    "id": 1,
    "payout_reference": "AFF_PAYOUT_001",
    "amount": 450.00,
    "status": "pending",
    "created_at": "2026-05-31T12:00:00Z"
  }
}
```

---

## Admin Endpoints

### Get Users List
Get list of users (admin only).

**Endpoint:** `GET /admin/users`

**Query Parameters:**
```
?role=traveler&status=active&sort=created_at&order=desc&page=1&per_page=50
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "role": "traveler",
      "status": "active",
      "is_verified": true,
      "created_at": "2026-05-31T12:00:00Z"
    }
  ],
  "pagination": {
    "total": 1250,
    "page": 1,
    "per_page": 50,
    "pages": 25
  }
}
```

### Get Admin Dashboard
Get admin dashboard metrics.

**Endpoint:** `GET /admin/dashboard`

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "total_users": 5250,
    "total_vendors": 450,
    "total_bookings": 12500,
    "total_revenue": 2500000.00,
    "this_month_bookings": 1200,
    "this_month_revenue": 250000.00,
    "active_users_today": 850,
    "pending_vendor_verifications": 15,
    "pending_refunds": 5,
    "fraud_alerts": 2
  }
}
```

### Get Analytics
Get platform analytics.

**Endpoint:** `GET /admin/analytics`

**Query Parameters:**
```
?period=month&metric=revenue,bookings,users&start_date=2026-01-01&end_date=2026-05-31
```

**Response:** `200 OK`
```json
{
  "success": true,
  "data": {
    "revenue": [
      {
        "date": "2026-05-01",
        "amount": 250000.00
      }
    ],
    "bookings": [
      {
        "date": "2026-05-01",
        "count": 1200
      }
    ],
    "users": [
      {
        "date": "2026-05-01",
        "count": 5250
      }
    ]
  }
}
```

### Approve Vendor
Approve pending vendor verification.

**Endpoint:** `POST /admin/vendors/{vendor_id}/approve`

**Request:**
```json
{
  "notes": "All documents verified"
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Vendor approved successfully"
}
```

### Suspend User/Vendor
Suspend a user or vendor account.

**Endpoint:** `POST /admin/users/{user_id}/suspend`

**Request:**
```json
{
  "reason": "Violation of terms of service",
  "duration_days": 30
}
```

**Response:** `200 OK`
```json
{
  "success": true,
  "message": "Account suspended successfully"
}
```

---

## Error Response Format

All error responses follow this format:

```json
{
  "success": false,
  "message": "Error description",
  "errors": {
    "field_name": ["Error message 1", "Error message 2"]
  }
}
```

### Common HTTP Status Codes
- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `429` - Too Many Requests (Rate Limited)
- `500` - Internal Server Error

---

## Rate Limiting

API endpoints are rate-limited based on user role:

- **Guest**: 100 requests/hour
- **Traveler**: 1000 requests/hour
- **Vendor**: 2000 requests/hour
- **Admin**: 5000 requests/hour

Rate limit headers:
```
X-RateLimit-Limit: 1000
X-RateLimit-Remaining: 999
X-RateLimit-Reset: 1625097600
```

---

## Pagination

List endpoints support pagination:

```
?page=1&per_page=10&sort=field&order=asc
```

Response includes:
```json
{
  "pagination": {
    "total": 250,
    "page": 1,
    "per_page": 10,
    "pages": 25
  }
}
```

---

**API Version**: 1.0
**Last Updated**: 2026-05-31
**Status**: Phase 3 - Complete
