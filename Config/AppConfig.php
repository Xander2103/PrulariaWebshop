<?php
// AppConfig.php - Algemene applicatie configuratie

declare(strict_types=1);

namespace Config;

class AppConfig
{
    // ========== AUTHENTICATIE INSTELLINGEN ==========
    
    // Session timeout (inactivity) - 30 minuten
    public const SESSION_TIMEOUT = 1800; // 30 * 60 seconden
    
    // Cookie bewaartijd voor "Onthoud mij" functionaliteit - 30 dagen
    public const REMEMBER_ME_DURATION = 2592000; // 30 * 24 * 60 * 60 seconden
    
    // Session naam
    public const SESSION_NAME = 'PRULARIA_SESSION';
    
    // Cookie naam voor "Onthoud mij"
    public const REMEMBER_ME_COOKIE = 'prularia_remember';
    
    
    // ========== WACHTWOORD REQUIREMENTS ==========
    
    // Minimale wachtwoord lengte
    public const PASSWORD_MIN_LENGTH = 8;
    
    // Wachtwoord moet minstens 1 hoofdletter bevatten
    public const PASSWORD_REQUIRE_UPPERCASE = true;
    
    // Wachtwoord moet minstens 1 cijfer bevatten
    public const PASSWORD_REQUIRE_DIGIT = true;
    
    // Wachtwoord moet minstens 1 speciaal karakter bevatten (optioneel)
    public const PASSWORD_REQUIRE_SPECIAL = false;
    
    
    // ========== WACHTWOORD RESET ==========
    
    // Reset token expiratie - 24 uur
    public const PASSWORD_RESET_TOKEN_EXPIRY = 86400; // 24 * 60 * 60 seconden
    
    
    // ========== PAGINERING ==========
    
    // Standaard aantal items per pagina
    public const ITEMS_PER_PAGE = 20;
    
    // Maximaal aantal zoekresultaten
    public const MAX_SEARCH_RESULTS = 50;
    
    
    // ========== VERZENDING & LEVERING ==========
    
    // Standaard levertijd in dagen
    public const DEFAULT_DELIVERY_DAYS = 1;
    
    // Marketingboodschap snelle levering
    public const DELIVERY_PROMISE = 'Voor 22u besteld, morgen in huis!';
    
    // Werkelijke levertijd voor algemene voorwaarden (in werkdagen)
    public const DELIVERY_TIME_MIN_DAYS = 1;
    public const DELIVERY_TIME_MAX_DAYS = 3;
}
