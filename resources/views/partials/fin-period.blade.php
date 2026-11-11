{{-- Which dates the Financials page is showing. The choice lives in the address, so a
     refresh, a saved link and the Back button all keep it. --}}
<div class="fin-period {{ $period['key'] === 'custom' ? 'open' : '' }}">
    <div class="fp-tabs">
        <a class="{{ $period['key'] === 'this_month' ? 'on' : '' }}" href="{{ url('/expenses') }}">This Month</a>
        <a class="{{ $period['key'] === 'last_month' ? 'on' : '' }}" href="{{ url('/expenses') }}?period=last_month">Last Month</a>
        <a class="{{ $period['key'] === 'all' ? 'on' : '' }}" href="{{ url('/expenses') }}?period=all">All Time</a>
        <button type="button" class="{{ $period['key'] === 'custom' ? 'on' : '' }}" onclick="this.closest('.fin-period').classList.toggle('open')">Custom</button>
    </div>
    <form class="fp-custom" method="GET" action="{{ url('/expenses') }}">
        <input type="hidden" name="period" value="custom">
        <input type="date" name="from" required value="{{ $period['key'] === 'custom' ? $period['from'] : '' }}" aria-label="From date">
        <span>to</span>
        <input type="date" name="to" required value="{{ $period['key'] === 'custom' ? $period['to'] : '' }}" aria-label="To date">
        <button type="submit">Apply</button>
    </form>
    <span class="fp-label">Showing <b>{{ $period['label'] }}</b></span>
</div>
