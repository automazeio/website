/* eslint-disable no-empty */
/* eslint-disable no-unused-vars */
/* jshint esversion: 9 */

function timeDiff(from, { to = null, showSeconds = true } = {}) {
  from = new Date(from).getTime();
  to = to ? new Date(to).getTime() : new Date().getTime();
  const milisecDiff = to - from;

  let days = Math.floor(milisecDiff / 1000 / 60 / (60 * 24));
  const dateDiff = new Date(milisecDiff);

  days = new Intl.NumberFormat('en-US', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(days);

  if (showSeconds) {
    return (
      `${days
      }<span class="!font-normal opacity-50">d</span> ${(`0${dateDiff.getHours()}`).slice(-2)
      }<span class="!font-normal opacity-50">h</span> ${(`0${dateDiff.getMinutes()}`).slice(-2)
      }<span class="!font-normal opacity-50">m</span> ${(`0${dateDiff.getSeconds()}`).slice(-2)
      }<span class="!font-normal opacity-50">s</span>`
    );
  }
  return (
    `${days
    }<span class="!font-normal opacity-50">d</span> ${(`0${dateDiff.getHours()}`).slice(-2)
    }<span class="!font-normal opacity-50">h</span> ${(`0${dateDiff.getMinutes()}`).slice(-2)
    }<span class="!font-normal opacity-50">m</span>`
  );
}

function formatTimeSince(value, prefix = '', postfix = ' ago') {
  const date = new Date(value);

  const seconds = Math.floor((new Date() - date) / 1000);
  let interval;

  interval = Math.floor(seconds / 31536000);
  if (interval >= 1) {
    return interval === 1 ? `${prefix} one year ${postfix}`.trim() : `${prefix} ${interval} years ${postfix}`.trim();
  }
  interval = Math.floor(seconds / 2592000);
  if (interval >= 1) {
    return interval === 1 ? `${prefix} one month ${postfix}`.trim() : `${prefix} ${interval} months ${postfix}`.trim();
  }
  interval = Math.floor(seconds / 86400);
  if (interval >= 1) {
    return interval === 1 ? `${prefix} yesterday`.trim() : `${prefix} ${interval} days ${postfix}`.trim();
  }
  interval = Math.floor(seconds / 3600);
  if (interval >= 1) {
    return interval === 1 ? `${prefix} one hour ${postfix}`.trim() : `${prefix} ${interval} hours ${postfix}`.trim();
  }
  interval = Math.floor(seconds / 60);
  if (interval >= 1) {
    return interval < 5 ? `${prefix} a few minutes ${postfix}`.trim() : `${prefix} ${interval} minutes ${postfix}`.trim();
  }

  interval = Math.floor(seconds);
  return interval < 10 ? `${prefix} a few seconds ${postfix}`.trim() : `${prefix} ${interval} seconds ${postfix}`.trim();
}

function formatMMSS(value) {
  const date = new Date(value * 1000).toISOString();
  return value < 3600 ? date.substring(14, 19) : date.substring(11, 16);
}


function formatDateTime(value, seconds) {
  const date = new Date(value);
  const options = {
    month: 'short',
    day: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hour12: false,
    hourCycle: 'h23',
    timeZone: 'UTC',
  };

  if (seconds) {
    options.second = '2-digit';
  }
  return date.toLocaleString(['en-US'], options).replace(' 0', ' ').replace(' 24:', ' 00:');
}

function formatDateTimeFriendly(value, seconds) {
  const date = new Date(value);
  const options = {
    month: 'short',
    day: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hour12: false,
    hourCycle: 'h23',
    timeZone: 'UTC',
  }

  if (seconds) {
    options.second = '2-digit';
  }
  const parts = date.toLocaleString(['en-US'], options).replace(' 24:', ' 00:').split(', ');
  return `${parts[0].replace(' 0', ' ')}, ${parts[1]} <span class="opacity-50">@</span> ${parts[2]}`;
}

function formatDateTimeAMPM(value, seconds) {
  const date = new Date(value);
  if (date.toString() === 'Invalid Date') {
    return value;
  }
  const options = {
    month: 'short',
    day: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hour12: true,
    timeZone: 'UTC',
  }

  if (seconds) {
    options.second = '2-digit';
  }
  return date.toLocaleString(['en-US'], options).replace(' 0', ' ');
}

function formatDate(value) {
  const date = new Date(value);
  return date.toLocaleString(['en-US'], {
    month: 'short',
    day: '2-digit',
    year: 'numeric',
    timeZone: 'UTC',
  });
}

function formatDateFriendly(value, undefined) {
  if (value === undefined) {
    return value;
  }
  const date = new Date(value);
  const now = new Date();
  const diffDays = now.getDate() - date.getDate();
  const diffMonths = now.getMonth() - date.getMonth();
  const diffYears = now.getFullYear() - date.getFullYear();

  if (diffYears === 0 && diffDays === 0 && diffMonths === 0) {
    return 'Today';
  } if (diffYears === 0 && diffDays === 1) {
    return 'Yesterday';
  }

  return date.toLocaleString(['en-US'], {
    month: 'short',
    day: '2-digit',
    year: 'numeric',
    timeZone: 'UTC',
  });
}

function formatTime(value, seconds) {
  const date = new Date(value);
  const options = {
    hour: '2-digit',
    minute: '2-digit',
    hour12: false,
    hourCycle: 'h23',
    timeZone: 'UTC',
  }

  if (seconds) {
    options.second = '2-digit';
  }
  return date.toLocaleString(['en-US'], options).replace(' 24:', ' 00:').toLowerCase().replace(' 0', ' ');
}

function formatTimeAMPM(value, seconds) {
  const date = new Date(value);
  const options = {
    hour: '2-digit',
    minute: '2-digit',
    hour12: true,
    hourCycle: 'h23',
    timeZone: 'UTC',
  }

  if (seconds) {
    options.second = '2-digit';
  }
  return date.toLocaleString(['en-US'], options).replace(' 24:', ' 00:').toLowerCase().replace(' 0', ' ');
}
