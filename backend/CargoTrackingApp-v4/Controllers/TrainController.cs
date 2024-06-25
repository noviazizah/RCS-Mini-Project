using Microsoft.AspNetCore.Mvc;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using CargoTrackingApp_v4.Data;
using CargoTrackingApp_v4.Models;
using Microsoft.EntityFrameworkCore;

namespace CargoTrackingApp_v4.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class TrainController : ControllerBase
    {
        private readonly ApplicationDbContext _context;

        public TrainController(ApplicationDbContext context)
        {
            _context = context;
        }

        // GET: api/Train
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Train>>> GetTrains()
        {
            return await _context.Trains.ToListAsync();
        }

        // GET: api/Train/KA%2001234
        [HttpGet("{id}")]
        public async Task<ActionResult<Train>> GetTrain(string id)
        {
            var train = await _context.Trains.FindAsync(id);

            if (train == null)
            {
                return NotFound();
            }

            return train;
        }

        // PUT: api/Train/KA%2001234
        [HttpPut("{id}")]
        public async Task<IActionResult> PutTrain(string id, Train train)
        {
            if (id != train.TrainNumber)
            {
                return BadRequest();
            }

            _context.Entry(train).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TrainExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Train
        [HttpPost]
        public async Task<ActionResult<Train>> PostTrain(Train train)
        {
            _context.Trains.Add(train);
            await _context.SaveChangesAsync();

            return CreatedAtAction("GetTrain", new { id = train.TrainNumber }, train);
        }

        // DELETE: api/Train/KA%2001234
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteTrain(string id)
        {
            var train = await _context.Trains.FindAsync(id);
            if (train == null)
            {
               return NotFound();
            }        _context.Trains.Remove(train);
        await _context.SaveChangesAsync();

        return NoContent();
    }

        private bool TrainExists(string id)
        {
            return _context.Trains.Any(e => e.TrainNumber == id);
        }
    }
}

