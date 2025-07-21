/* eslint-disable no-empty */
/* eslint-disable no-unused-vars */
/* jshint esversion: 9 */
function formatDecimal(value, decimals, sign) {
  sign = sign || false;
  const sumbol = sign && value > 0 ? '+' : '';
  decimals = decimals || 2;
  const num = new Intl.NumberFormat('en-US', {
    minimumFractionDigits: decimals,
    maximumFractionDigits: decimals,
  }).format(value);
  return `${sumbol}${num}`;
}

function formatNumber(value, sign) {
  sign = sign || false;
  const sumbol = sign && value > 0 ? '+' : '';
  const num = new Intl.NumberFormat('en-US', {}).format(value);
  return `${sumbol}${num}`;
}

function formatInt(value, sign) {
  sign = sign || false;
  const sumbol = sign && value > 0 ? '+' : '';
  const num = new Intl.NumberFormat('en-US', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(value);
  return `${sumbol}${num}`;
}

// function abbrNumber(value, sign) {
//   sign = sign || false;
//   // eslint-disable-next-line no-nested-ternary
//   const sumbol = sign ? (value < 0 ? '-' : '+') : '';
//   const absvalue = Math.abs(value);
//   if (absvalue >= 1000000000000) {
//     // eslint-disable-next-line max-len
//     return `${new Intl.NumberFormat('en-US', { maximumFractionDigits: 1 }).format(absvalue / 1000000000000).replace(/\.0$/, '')}T`;
//   }
//   if (absvalue >= 1000000000) {
//     // eslint-disable-next-line max-len
//     return `${new Intl.NumberFormat('en-US', { maximumFractionDigits: 1 }).format(absvalue / 1000000000).replace(/\.0$/, '')}B`;
//   }
//   if (absvalue >= 1000000) {
//     // eslint-disable-next-line max-len
//     return `${new Intl.NumberFormat('en-US', { maximumFractionDigits: 1 }).format(absvalue / 1000000).replace(/\.0$/, '')}M`;
//   }
//   if (absvalue >= 1000) {
//     // eslint-disable-next-line max-len
//     return `${new Intl.NumberFormat('en-US', { maximumFractionDigits: 1 }).format(absvalue / 1000).replace(/\.0$/, '')}K`;
//   }
//   return `${sumbol}${value}`;
// }

